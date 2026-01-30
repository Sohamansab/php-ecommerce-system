<?php
session_start();
include 'partials/_dbconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$id = $_GET['id'] ?? '';
// if (!is_numeric($id)) {
//     echo "Invalid product ID.";
//     exit;
// }

$id = intval($id);
$p = mysqli_query($conn, "SELECT product_name FROM tbl_products WHERE id = $id");
if (mysqli_num_rows($p) == 0) {
    echo "Product not found.";
    exit;
}

$name = mysqli_fetch_assoc($p)['product_name'];
$imgs = mysqli_query($conn, "SELECT image_path FROM product_images WHERE product_id = $id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Images - <?= $name ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h4>Images for: <?= $name ?></h4>
    <a href="manage_products.php" class="btn btn-sm btn-secondary mb-3">Back</a>
    <div class="row">
        <?php if (mysqli_num_rows($imgs) > 0) {
            while ($img = mysqli_fetch_assoc($imgs)) { ?>
                <div class="col-md-3 mb-3">
                    <img src="images_folder/<?= $img['image_path'] ?>" class="img-fluid border">
                </div>
        <?php }} else {
            echo "<p>No images found.</p>";
        } ?>
    </div>
</body>
</html>
