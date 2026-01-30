<!-- <?php
include 'partials/_dbconnect.php';

if (!isset($_GET['id'])) {
    echo "Invalid product.";
    exit;
}

$product_id = intval($_GET['id']);
$sql = "SELECT image_path FROM product_images WHERE product_id = $product_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($img = mysqli_fetch_assoc($result)) {
        $path = 'images_folder/' . $img['image_path'];
        echo '<img src="' . htmlspecialchars($path) . '" alt="Product Image">';
    }
} else {
    echo "<p style='color:#555;'>No images found for this product.</p>";
}
?> -->
