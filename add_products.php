<?php
session_start();
include 'partials/_dbconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$error = '';
$success = '';
$productname = '';
$description = '';
$price = '';
$status = '';
$demand = '';
$category_id = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productname = isset($_POST['productname']) ? trim($_POST['productname']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
    $status = isset($_POST['status']) ? intval($_POST['status']) : 0;
    $demand = isset($_POST['demand']) ? $_POST['demand'] : '';
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $createdBy = isset($_SESSION['username']) ? $_SESSION['username'] : 'admin';
    $images = '';

    if ($productname == '' || $description == '' || $price <= 0 || $category_id == 0) {
        $error = "Please fill all required fields.";
    } else {
        $category_name = '';
        $cat_result = $conn->query("SELECT name FROM categories WHERE id = $category_id LIMIT 1");
        if ($cat_result && $cat_result->num_rows > 0) {
            $row = $cat_result->fetch_assoc();
            $category_name = $row['name'];
        }
//Limit 5
        $totalFiles = isset($_FILES['userImages']) ? count($_FILES['userImages']['name']) : 0;

        if ($totalFiles > 5) {
            $error = "You cannot upload more than 5 images.";
        } else {
            $uploadedImages = [];
            if ($totalFiles > 0) {
                $uploadDir = __DIR__ . "/images_folder/temp/";

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                for ($i = 0; $i < $totalFiles; $i++) {
                   $tmpFile = $_FILES['userImages']['tmp_name'][$i];
$originalName = basename($_FILES['userImages']['name'][$i]);

if (empty($tmpFile) || !file_exists($tmpFile)) {
    continue; 
}

$fileType = mime_content_type($tmpFile);


                    if (str_starts_with($fileType, 'image/')) {
                        $uniqueName = time() . '_' . uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $originalName);
                        $destination = $uploadDir . $uniqueName;

                        if (move_uploaded_file($tmpFile, $destination)) {
                            $uploadedImages[] = $uniqueName;
                        }
                    } else {
                        $error = "Only image files are allowed.";
                        break;
                    }
                }
            }

            if (!$error) {
                $sql = "INSERT INTO tbl_products (
    product_name, 
    product_description, 
    product_price, 
    isHotSale, 
    isActive, 
    category_id, 
    product_created_by
) VALUES (
    '$productname', 
    '$description', 
    $price, 
    " . ($demand === 'Hot Selling' ? 1 : 0) . ", 
    $status, 
    $category_id, 
    '$createdBy'
)";

                if ($conn->query($sql) === TRUE) {
                    $productId = $conn->insert_id;

                    if (!empty($uploadedImages)) {
                        $finalDir = __DIR__ . "/images_folder/$productId/";
                        if (!is_dir($finalDir)) {
                            mkdir($finalDir, 0777, true);
                        }

                        foreach ($uploadedImages as $imgName) {
                            $tempPath = __DIR__ . "/images_folder/temp/" . $imgName;
                            $newPath = $finalDir . $imgName;
                            if (rename($tempPath, $newPath)) {
                                $imagePath = "$productId/$imgName";
                                $conn->query("INSERT INTO product_images (product_id, image_path) VALUES ($productId, '$imagePath')");
                            }
                        }
                        @rmdir(__DIR__ . "/images_folder/temp/");
                    }

                    $success = "Product added successfully.";
                    $productname = $description = $price = $status = $demand = $category_id = '';
                } else {
                    $error = "Error: " . $conn->error;
                }
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Add Product</title>
  <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>

<body class="d-flex flex-column min-vh-100">
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
      data-sidebar-position="fixed" data-header-position="fixed">

    <?php include('./Layouts/header.php');?>
    <?php include('./Layouts/sidebar.php');?>

    <div class="body-wrapper">
      <?php include('./Layouts/header2.php');?>
      <div class="body-wrapper-inner">
        <div class="container-fluid">

          <div class="container mt-4">
            <h3>Add New Product</h3>

            <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

            <form method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label>Product Name</label>
                <input type="text" name="productname" class="form-control" value="<?= htmlspecialchars($productname) ?>" required>
              </div>
              <div class="mb-3">
                <label>Description</label>
                <input type="text" name="description" class="form-control" value="<?= htmlspecialchars($description) ?>" required>
              </div>
              <div class="mb-3">
                <label>Price</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($price) ?>" required>
              </div>
              <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                  <option value="1" <?= ($status == 1) ? 'selected' : '' ?>>Available</option>
                  <option value="0" <?= ($status == 0) ? 'selected' : '' ?>>Not Available</option>
                </select>
              </div>
              <div class="mb-3">
                <label>Demand</label>
                <select name="demand" class="form-select">
                  <option value="Standard" <?= ($demand === 'Standard') ? 'selected' : '' ?>>Standard</option>
                  <option value="Hot Selling" <?= ($demand === 'Hot Selling') ? 'selected' : '' ?>>Hot Selling</option>
                </select>
              </div>
              <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-select" required>
                  <option value="">Select</option>
                  <?php
                  $cat_query = $conn->query("SELECT id, name FROM categories ORDER BY name ASC");
                  while ($cat = $cat_query->fetch_assoc()) {
                      $selected = ($category_id == $cat['id']) ? 'selected' : '';
                      echo "<option value='{$cat['id']}' $selected>" . htmlspecialchars($cat['name']) . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label>Upload Images (Max 5)</label>
                <input type="file" name="userImages[]" class="form-control" accept="image/*" multiple required>
              </div>
              <button type="submit" class="btn btn-primary">Add Product</button>
              <a href="manage_products.php" class="btn btn-secondary">Back</a>
            </form>
          </div>

          <?php include('./Layouts/footer.php');?>

        </div>
      </div>
    </div>
  </div>

  <?php include('./Layouts/footerlinks.php');?>

  

  <script>
    document.querySelector('input[name="userImages[]"]').addEventListener('change', function() {
      if (this.files.length > 5) {
        alert("You can only upload up to 5 images.");
        this.value = ''; 
      }
    });

    window.addEventListener('pageshow', function (event) {
      if (event.persisted || window.performance.navigation.type === 2) {
        window.location.reload();
      }
    });
  </script>
</body>
</html>
