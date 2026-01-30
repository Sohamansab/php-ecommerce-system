<?php
session_start();
include 'partials/_dbconnect.php';

if (empty($_POST['image_id'])) {
    header("Location: manage_products.php");
    exit;
}

$image_id = (int)$_POST['image_id'];
$query = mysqli_query($conn, "SELECT image_path FROM product_images WHERE id = $image_id");

if ($row = mysqli_fetch_assoc($query)) {
    $imagePath = $row['image_path'];
    $fullPath = __DIR__ . '/images_folder/' . $imagePath;

    if (file_exists($fullPath)) {
        unlink($fullPath);
    }

    mysqli_query($conn, "DELETE FROM product_images WHERE id = $image_id");

    $productId = explode('/', $imagePath)[0];
    header("Location: edit_products.php?id=$productId");
    exit;
}

echo "Image not found.";
