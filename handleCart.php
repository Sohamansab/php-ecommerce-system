<?php
session_start();
include 'partials/_dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION['user_loggedin'], $_SESSION['user_id']) || $_SESSION['user_loggedin'] !== true) {
    echo 401;
    exit;
}

$userId = $_SESSION['user_id'];

// Handle check request (for login verification)
if (isset($_POST['scope']) && $_POST['scope'] == 'check') {
    echo 200; // User is logged in
    exit;
}

if (isset($_POST['scope']) && $_POST['scope'] == 'add') {
    $prod_id = $_POST['prod_id'];
    $qty = $_POST['prod_qty'];

    $check = mysqli_query($conn, "SELECT * FROM tbl_carts WHERE user_id='$userId' AND prod_id='$prod_id'");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "UPDATE tbl_carts SET prod_qty = prod_qty + $qty WHERE user_id='$userId' AND prod_id='$prod_id'");
        echo 201;
    } else {
        mysqli_query($conn, "INSERT INTO tbl_carts (user_id, prod_id, prod_qty) VALUES ('$userId', '$prod_id', '$qty')");
        echo 201;
    }
}

if (isset($_POST['scope']) && $_POST['scope'] == 'delete') {
    $cart_id = $_POST['cart_id'];
    mysqli_query($conn, "DELETE FROM tbl_carts WHERE id='$cart_id' AND user_id='$userId'");
    echo 200;
}
?>
