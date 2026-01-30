<?php
session_start();
include 'partials/_dbconnect.php';
include 'partials/eheader.php';

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['user_loggedin'], $_SESSION['user_id']) || $_SESSION['user_loggedin'] !== true) {
    header("Location: user_login.php");
    exit;
}


$userId = $_SESSION['user_id'];

$cartSql = "SELECT c.*, p.product_name, p.product_price AS price, pi.image_path 
            FROM tbl_carts c 
            INNER JOIN tbl_products p ON c.prod_id = p.product_id
            LEFT JOIN product_images pi ON pi.product_id = p.product_id
            WHERE c.user_id = '$userId'";

$cartResult = mysqli_query($conn, $cartSql);

if (!$cartResult || mysqli_num_rows($cartResult) == 0) {
    echo "<div class='container my-5 text-center'><h3>Your cart is empty.</h3></div>";
    include 'partials/efooter.php';
    exit;
}

$total = 0;
while ($row = mysqli_fetch_assoc($cartResult)) {
    $total += $row['price'] * $row['prod_qty'];
}
mysqli_data_seek($cartResult, 0);

$orderPlaced = false;
$orderNo = '';
$paymentMode = 'COD';

$isPaypal = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_mode']) && $_POST['payment_mode'] === 'PayPal') {
    $isPaypal = true;
}

$fullName = '';
$email = '';
$phone = '';
$address = '';
$city = '';
$country = '';
$postalCode = '';
$paymentMode = 'COD';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty(trim($_POST['full_name'] ?? ''))) {
        $errors[] = "Full Name is required.";
    } else {
        $fullName = mysqli_real_escape_string($conn, trim($_POST['full_name']));
    }

    if (empty(trim($_POST['email'] ?? ''))) {
        $errors[] = "Email is required.";
    } elseif (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    } else {
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    }

    if (empty(trim($_POST['phone'] ?? ''))) {
        $errors[] = "Phone number is required.";
    } elseif (!preg_match('/^\d{10,15}$/', trim($_POST['phone']))) {
        $errors[] = "Please enter a valid phone number (10 to 15 digits).";
    } else {
        $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    }

    if (empty(trim($_POST['address'] ?? ''))) {
        $errors[] = "Address is required.";
    } else {
        $address = mysqli_real_escape_string($conn, trim($_POST['address']));
    }

    if (empty(trim($_POST['city'] ?? ''))) {
        $errors[] = "City is required.";
    } else {
        $city = mysqli_real_escape_string($conn, trim($_POST['city']));
    }

    if (empty(trim($_POST['country'] ?? ''))) {
        $errors[] = "Country is required.";
    } else {
        $country = mysqli_real_escape_string($conn, trim($_POST['country']));
    }

    if (empty(trim($_POST['postal_code'] ?? ''))) {
        $errors[] = "Postal Code is required.";
    } else {
        $postalCode = mysqli_real_escape_string($conn, trim($_POST['postal_code']));
    }

    $paymentMode = mysqli_real_escape_string($conn, $_POST['payment_mode'] ?? 'COD');

    if (empty($errors)) {

    $orderNo = 'ORD' . strtoupper(uniqid());

    $profileSql = "INSERT INTO tbl_profile_info 
        (user_id, full_name, contact_number, shipping_address, city, province, postal_code)
        VALUES ('$userId', '$fullName', '$phone', '$address', '$city', '$country', '$postalCode')";
    mysqli_query($conn, $profileSql);

    $userInfoId = mysqli_insert_id($conn);

    $orderSql = "INSERT INTO tbl_order 
        (user_id, user_info_id, order_number, total_amount, payment_method, payment_status, status)
        VALUES ('$userId', '$userInfoId', '$orderNo', '$total', '$paymentMode', 'Pending', 'Pending')";
    mysqli_query($conn, $orderSql);
    $orderId = mysqli_insert_id($conn);

    $itemsHtml = '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse;width:100%">';
    $itemsHtml .= '<tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                   </tr>';

    mysqli_data_seek($cartResult, 0);
    while ($item = mysqli_fetch_assoc($cartResult)) {
        $prodId    = $item['prod_id'];
        $productName = mysqli_real_escape_string($conn, $item['product_name']);
        $qty       = $item['prod_qty'];
        $unitPrice = $item['price'];
        $totalPrice = $unitPrice * $qty;

        $itemSql = "INSERT INTO tbl_order_item 
            (order_id, id_item, products, qty, unit_price)
            VALUES ('$orderId', '$prodId', '$productName', '$qty', '$unitPrice')";
        mysqli_query($conn, $itemSql);

        $itemsHtml .= "<tr>
                        <td>$productName</td>
                        <td>$qty</td>
                        <td>\$$unitPrice</td>
                        <td>\$$totalPrice</td>
                       </tr>";
    }
    $itemsHtml .= '</table>';

    mysqli_query($conn, "DELETE FROM tbl_carts WHERE user_id = '$userId'");


            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'sohamansab@gmail.com';
                $mail->Password   = 'lktp mnzu kxyy adkv';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('sohamansab@gmail.com', 'EStore');
                $mail->addAddress($email, $fullName);

                $mail->isHTML(true);
                $mail->Subject = "Order Confirmation - $orderNo";
                $mail->Body = "
                    <h2>Thank you for your order, $fullName!</h2>
                    <p>Order Number: <strong>$orderNo</strong></p>
                    <p>Payment Method: <strong>$paymentMode</strong></p>
                    <p>Total Amount: <strong>\$$total</strong></p>
                    <h3>Order Details:</h3>
                    $itemsHtml
                    <p>We will process your order shortly.</p>
                    <p>Regards,<br>E‑Store</p>
                ";
                $mail->send();
            } catch (Exception $e) {
            }

            $orderPlaced = true;
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $orderPlaced ? 'Order Successful' : 'Checkout' ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body 
{
     background-color: #f8f9fa;
     }
.card 
{ border-radius: 10px;
 }
h3,h2
 { font-weight: 600; color: #333;
 }
.btn-success
 { 
    background-color: #198754; border: none; 
}
.btn-success:hover 
{ background-color: #157347; 
}
.success-icon { 
    font-size: 60px; color: #28a745;
     }
</style>
<script src="https://www.paypal.com/sdk/js?client-id=AT8RSepAgf1gElnBaopMC0reeyi5yyBsIbryIdQG1yAB2lxx_M0OLGncjEn3V4Z_i-V0hDqiND007VUa&currency=USD"></script>
</head>
<body>

<?php if ($orderPlaced): ?>
<div class="container my-5 text-center">
    <div class="card shadow-sm border-0 p-5">
        <div class="success-icon mb-3">✅</div>
        <h2 class="text-success mb-3">Thank You for Your Order!</h2>
        <p class="text-muted fs-5 mb-3">Your order has been placed successfully.</p>
        <p class="mb-1">Order Number: <strong><?= $orderNo ?></strong></p>
        <p class="mb-1">Payment Method: <strong><?= htmlspecialchars($paymentMode) ?></strong></p>
        <p class="mb-4">Total Amount: <strong>$<?= number_format($total, 2) ?></strong></p>
        <a href="home.php" class="btn btn-primary px-4 me-2">Continue Shopping</a>
        <a href="orders.php" class="btn btn-outline-success px-4">View My Orders</a>
    </div>
</div>
<?php else: ?>
<div class="container my-5">
    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">Checkout</h3>
                    <form method="POST" id="checkout-form">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2" ></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Postal Code</label>
                            <input type="text" name="postal_code" class="form-control" >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Payment Method</label><br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_mode" id="cod" value="COD" checked>
                                <label class="form-check-label" for="cod">Cash on Delivery (COD)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_mode" id="paypal" value="PayPal">
                                <label class="form-check-label" for="paypal">PayPal</label>
                            </div>
                            <div id="paypal-button-container" style="display: none;"></div>
                        </div>

                        <div class="text-center mb-3">
                            <h5 class="text-muted">Total Amount: <span class="text-success">$<?= number_format($total, 2) ?></span></h5>
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-2" id="place-order-btn">Place Order</button>
                        <a href="cart.php" class="btn btn-outline-secondary w-100 mt-2">Back to Cart</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const paypalRadio   = document.getElementById('paypal');
    const codRadio      = document.getElementById('cod');
    const paypalContainer = document.getElementById('paypal-button-container');
    const placeOrderBtn   = document.getElementById('place-order-btn');
    const form            = document.getElementById('checkout-form');

    function togglePaypal(show) {
        paypalContainer.style.display = show ? 'block' : 'none';
        placeOrderBtn.style.display  = show ? 'none'  : 'block';
    }

    paypalRadio.addEventListener('change', function () {
        if (this.checked) togglePaypal(true);
    });
    codRadio.addEventListener('change', function () {
        if (this.checked) togglePaypal(false);
    });

    paypal.Buttons({
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= number_format($total, 2) ?>'
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(function(details) {
                const inputMode = document.createElement('input');
                inputMode.type  = 'hidden';
                inputMode.name  = 'payment_mode';
                inputMode.value = 'PayPal';
                form.appendChild(inputMode);

                const inputTx = document.createElement('input');
                inputTx.type  = 'hidden';
                inputTx.name  = 'paypal_txn_id';
                inputTx.value = details.id;
                form.appendChild(inputTx);

                form.submit();
            });
        }
    }).render('#paypal-button-container');
});
</script>
<?php endif; ?>

</body>
</html>

<?php include 'partials/efooter.php'; ?>
