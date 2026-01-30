<?php
session_start();
include 'partials/_dbconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: manage_products.php");
    exit;
}

$product_id = $_GET['id'];
$query = "SELECT * FROM tbl_products WHERE product_id = '$product_id'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Product not found.");
}

$product = mysqli_fetch_assoc($result);
if (isset($_GET['delete_image']) && is_numeric($_GET['delete_image'])) {
    $delete_id = intval($_GET['delete_image']);
    $img_query = mysqli_query($conn, "SELECT * FROM product_images WHERE id = $delete_id AND product_id = $product_id");
    
    if ($img_query && mysqli_num_rows($img_query) > 0) {
        $img = mysqli_fetch_assoc($img_query);
        $file_path = __DIR__ . '/images_folder/' . $img['image_path'];

        if (file_exists($file_path)) {
            unlink($file_path); 
        }

        mysqli_query($conn, "DELETE FROM product_images WHERE id = $delete_id"); 
    }

    header("Location: edit_products.php?id=$product_id");
    exit;
}


// Fetch existing images
$existing_images_result = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = $product_id");
$existing_images = [];
if ($existing_images_result) {
    while ($img = mysqli_fetch_assoc($existing_images_result)) {
        $existing_images[] = $img;
    }
}

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, trim($_POST['productname'] ?? ''));
    $description = mysqli_real_escape_string($conn, trim($_POST['description'] ?? ''));
    $price = floatval($_POST['price'] ?? 0);
    $status = intval($_POST['status'] ?? 0);
    $demand = mysqli_real_escape_string($conn, $_POST['demand'] ?? '');
    $category_id = intval($_POST['category_id'] ?? 0);

    if ($name === '' || $description === '' || $price <= 0 || $category_id <= 0) {
        $error_message = "Please fill in all required fields with valid values.";
    } else {
        $cat_result = mysqli_query($conn, "SELECT name FROM categories WHERE id = $category_id");
        if ($cat_result && mysqli_num_rows($cat_result) > 0) {
            $cat = mysqli_fetch_assoc($cat_result);
            $category_name = mysqli_real_escape_string($conn, $cat['name']);
        } else {
            $error_message = "Selected category not found.";
        }
    }

    $updated_by = mysqli_real_escape_string($conn, $_SESSION['username']);

    if (!$error_message) {
     $update_query = "UPDATE tbl_products SET 
    product_name = '$name', 
    product_description = '$description', 
    product_price = $price, 
    isActive = $status, 
    isHotSale = '$demand', 
    category_id = $category_id, 
    product_updated_by = '$updated_by', 
    product_updated_at = NOW()
WHERE product_id = '$product_id'";

        if (mysqli_query($conn, $update_query)) {
            $existing_count = count($existing_images);
            $remaining_slots = 5 - $existing_count;

            if (isset($_FILES['userImages']) && !empty($_FILES['userImages']['name'][0])) {
                $totalFiles = count($_FILES['userImages']['name']);

                if ($totalFiles > $remaining_slots) {
                    $error_message = "You can only upload $remaining_slots more image(s).";
                } else {
                    $uploadDir = __DIR__ . "/images_folder/$product_id";
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    for ($i = 0; $i < $totalFiles; $i++) {
                        if ($_FILES['userImages']['error'][$i] !== UPLOAD_ERR_OK) {
                            $error_message = "Error uploading file: " . $_FILES['userImages']['name'][$i];
                            break;
                        }

                        $tmpFile = $_FILES['userImages']['tmp_name'][$i];
                        $originalName = basename($_FILES['userImages']['name'][$i]);
                        $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $originalName);
                        $uniqueName = time() . '_' . uniqid() . '_' . $safeName;
                        $destination = $uploadDir . '/' . $uniqueName;

                        if (move_uploaded_file($tmpFile, $destination)) {
                            $imagePath = "$product_id/$uniqueName";
                            mysqli_query($conn, "INSERT INTO product_images (product_id, image_path) VALUES ($product_id, '" . mysqli_real_escape_string($conn, $imagePath) . "')");
                        } else {
                            $error_message = "Failed to upload file: $originalName";
                            break;
                        }
                    }
                }
            }

       if (!$error_message) {
    $success_message = "Product updated successfully.";
    $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tbl_products WHERE product_id = $product_id"));
    $existing_images_result = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = $product_id");
    $existing_images = [];
    if ($existing_images_result) {
        while ($img = mysqli_fetch_assoc($existing_images_result)) {
            $existing_images[] = $img;
        }
    }
}

        } else {
            $error_message = "Error updating product: " . mysqli_error($conn);
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>
<body class="d-flex flex-column min-vh-100">

<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
     data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

    <?php include('./Layouts/header.php'); ?>
    <?php include('./Layouts/sidebar.php'); ?>

    <div class="body-wrapper">
        <?php include('./Layouts/header2.php'); ?>
        <div class="container-fluid mt-4">
            <h2>Edit Product</h2>

            <?php if ($success_message): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
            <?php endif; ?>
            <?php if ($error_message): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Product Name</label>
                    <input type="text" name="productname" class="form-control" value="<?= htmlspecialchars($product['product_name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control" value="<?= htmlspecialchars($product['product_description']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($product['product_price']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
<option value="1" <?= ($product['isActive'] == 1) ? "selected" : "" ?>>Available</option>
<option value="0" <?= ($product['isActive'] == 0) ? "selected" : "" ?>>Not Available</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Demand</label>
                    <select name="demand" class="form-select">
<option value="0" <?= ($product['isHotSale'] == 0) ? "selected" : "" ?>>Standard</option>
<option value="1" <?= ($product['isHotSale'] == 1) ? "selected" : "" ?>>Hot Selling</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Select Category</option>
                        <?php
                        $cat_result = mysqli_query($conn, "SELECT id, name FROM categories ORDER BY name ASC");
                        while ($cat = mysqli_fetch_assoc($cat_result)) {
                            $selected = ($product['category_id'] == $cat['id']) ? 'selected' : '';
                            echo "<option value='" . intval($cat['id']) . "' $selected>" . htmlspecialchars($cat['name']) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Existing Images (<?= count($existing_images) ?>/5)</label>
                    <ul class="list-group">
    <?php foreach ($existing_images as $img): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= htmlspecialchars(basename($img['image_path'])) ?>
            <a href="?id=<?= $product_id ?>&delete_image=<?= $img['id'] ?>" 
               onclick="return confirm('Delete this image?')" 
               class="btn btn-sm btn-danger">
                Delete
            </a>
        </li>
    <?php endforeach; ?>
</ul>

                </div>

                <div class="mb-3">
                    <label>Upload Additional Images</label>
                    <input type="file" name="userImages[]" multiple class="form-control" accept="image/*">
                    <small class="text-muted">You can upload up to <?= 5 - count($existing_images) ?> more image(s).</small>
                </div>

                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="manage_products.php" class="btn btn-secondary ms-2">Back</a>
            </form>
        </div>
    </div>
</div>

<?php include('./Layouts/footer.php'); ?>
<?php include('./Layouts/footerlinks.php'); ?>
</body>
</html>
