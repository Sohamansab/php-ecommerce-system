<?php
session_start();
include 'partials/_dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
</head>
<style>
    body {
        background: #f5f7fa;
        font-family: "Poppins", sans-serif;
    }

    h2 {
        font-weight: 700;
        color: #222;
        letter-spacing: 0.5px;
    }

    /* Cart Table Wrapper */
    .cart-wrapper {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0px 10px 30px rgba(0,0,0,0.08);
    }

    /* Table Styling */
    table.table {
        border-radius: 10px;
        overflow: hidden;
    }

    thead.table-dark {
        background: #1a1a1a !important;
    }

    table.table td, table.table th {
        vertical-align: middle !important;
    }

    /* Image Styling */
    .table img {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        object-fit: cover;
        transition: 0.3s ease;
    }
    .table img:hover {
        transform: scale(1.08);
    }

    /* Delete Button */
    .btn-danger.btn-sm {
        border-radius: 50px;
        padding: 6px 14px;
        font-size: 14px;
        transition: 0.3s ease;
    }

    .btn-danger.btn-sm:hover {
        background-color: #b80000;
        transform: translateY(-2px);
    }

    /* Checkout Button */
    .btn-success.btn-lg {
        padding: 12px 28px;
        border-radius: 50px;
        font-size: 18px;
        font-weight: 600;
        background: linear-gradient(45deg, #28a745, #32d66d);
        border: none;
        transition: 0.3s ease;
        box-shadow: 0px 6px 15px rgba(40,167,69,0.3);
    }

    .btn-success.btn-lg:hover {
        transform: scale(1.04);
        box-shadow: 0px 10px 22px rgba(40,167,69,0.38);
    }

    /* Grand Total Styling */
    h4 strong {
        color: #28a745;
        font-size: 24px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    /* Empty Cart */
    .alert-info {
        font-size: 18px;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0px 4px 20px rgba(0,0,0,0.05);
    }

    /* Table Hover Effect */
    table.table tbody tr {
        transition: 0.2s ease;
    }
    table.table tbody tr:hover {
        background: #f9f9f9;
    }
</style>

<body>

<?php include 'partials/eheader.php'; ?>

<?php
if (!isset($_SESSION['user_loggedin'], $_SESSION['user_id']) || $_SESSION['user_loggedin'] !== true) {
    echo "<script>
        alert('Please login to view your cart.');
        window.location.href='user_login.php';
    </script>";
    exit;
}


$userId = $_SESSION['user_id'];

$sql = "SELECT 
            c.id AS cart_id, 
            c.prod_qty, 
            p.product_id AS prod_id, 
            p.product_name, 
            p.product_price AS price, 
            i.image_path
        FROM tbl_carts c
        JOIN tbl_products p ON c.prod_id = p.product_id
        LEFT JOIN product_images i ON i.product_id = p.product_id
        WHERE c.user_id='$userId'
        GROUP BY c.id
        ORDER BY c.id DESC";



$result = mysqli_query($conn, $sql);

if(!$result){
    echo "<div class='alert alert-danger text-center mt-5'>Error fetching cart items: " . mysqli_error($conn) . "</div>";
    $result = [];
}
?>

<div class="container my-5">
    <h2 class="mb-4 text-center">Your Cart</h2>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered table-hover text-center align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grandTotal = 0;
                    while ($row = mysqli_fetch_assoc($result)):
                        $image = !empty($row['image_path']) ? 'images_folder/' . $row['image_path'] : 'images_folder/no-image.jpg';
                        $total = $row['price'] * $row['prod_qty'];
                        $grandTotal += $total;
                    ?>
                    <tr data-id="<?= $row['cart_id'] ?>">
                        <td class="align-middle">
                            <img src="<?= $image ?>" alt="<?= htmlspecialchars($row['product_name']) ?>" 
                                 class="rounded" style="width:80px; height:80px; object-fit:cover;">
                        </td>
                        <td class="align-middle"><?= htmlspecialchars($row['product_name']) ?></td>
                        <td class="align-middle">$<?= number_format($row['price'],2) ?></td>
                        <td class="align-middle"><?= $row['prod_qty'] ?></td>
                        <td class="align-middle">$<?= number_format($total,2) ?></td>
                        <td class="align-middle">
                            <button class="btn btn-danger btn-sm delete-item">Delete</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4 flex-column flex-md-row gap-3">
            <h4>Grand Total: <strong>$<?= number_format($grandTotal,2) ?></strong></h4>
            <a href="checkout.php" class="btn btn-success btn-lg">Proceed to Checkout</a>
        </div>

    <?php else: ?>
        <div class="alert alert-info text-center">Your cart is empty.</div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
$('.delete-item').click(function(){
    var row = $(this).closest('tr');
    var cartId = row.data('id');

    $.post('handleCart.php', { cart_id: cartId, scope: 'delete' }, function(response){
        if(response == 200){
            alertify.success('Item removed');
            row.fadeOut(300, function(){ $(this).remove(); });
            location.reload();
        } else {
            alertify.error('Delete failed');
        }
    });
});
</script>

<?php include 'partials/efooter.php'; ?>
</body>
</html>
