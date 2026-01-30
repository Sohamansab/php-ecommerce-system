<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

include 'partials/_dbconnect.php';

// Pagination 
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 10;
$start_from = ($page - 1) * $records_per_page;

$sql = "
SELECT 
    p.*,
    uc.username AS created_by_name,
    uu.username AS updated_by_name
FROM tbl_products AS p
LEFT JOIN tbl_users AS uc ON p.product_created_by = uc.sno
LEFT JOIN tbl_users AS uu ON p.product_updated_by = uu.sno
ORDER BY p.product_id DESC
LIMIT $start_from, $records_per_page
";


$total_records_query = "SELECT COUNT(*) AS total FROM tbl_products";
$total_records_result = mysqli_query($conn, $total_records_query);
$total_records = mysqli_fetch_assoc($total_records_result)['total'];
$total_pages = ceil($total_records / $records_per_page);

$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
    <link href="https://unpkg.com/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/styles.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Manage Products</title>

    <style>
    .content-wrapper {
        padding-top: 190%;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

<!-- Main Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">

    <?php include __DIR__ . '/Layouts/header.php'; ?>
    <?php include __DIR__ . '/Layouts/sidebar.php'; ?>

    <!-- Body Wrapper -->
    <div class="body-wrapper">

        <!-- Header (second) -->
        <?php include __DIR__ . '/Layouts/header2.php'; ?>

        <!-- Main Content -->
        <div class="container-fluid content-wrapper">
            <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                <h3 class="mb-0">Manage Products</h3>
                <a href="add_products.php" class="btn btn-primary">Add Products</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Demand</th>
                            <!-- <th>Created By</th>
                            <th>Created At</th>
                            <th>Updated By</th>
                            <th>Updated At</th> -->
                            <th>Status</th>
                            <th>Images</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = htmlspecialchars($row['product_id']);
        $product_name = htmlspecialchars($row['product_name']);
      $description = htmlspecialchars($row['product_description'] ?? 'N/A');
$price = htmlspecialchars($row['product_price'] ?? '0.00');
$isHotSale = $row['isHotSale'] ?? 0;
$demand = ($isHotSale == 1) ? 'Hot Selling' : 'Standard';
$status = htmlspecialchars($row['isActive'] ?? 'N/A');

$created_by = htmlspecialchars($row['created_by'] ?? 'N/A');
$created_at = htmlspecialchars($row['product_created_at'] ?? 'N/A');
$updated_by = htmlspecialchars($row['updated_by'] ?? 'N/A');
$updated_at = htmlspecialchars($row['product_updated_at'] ?? 'N/A');


        $images = $row['images'] ?? '';
?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $product_name ?></td>
        <td><?= $description ?></td>
        <td>$<?= number_format((float)$price, 2) ?></td>
        <td>
            <?php if (strtolower($demand) === 'hot selling'): ?>
                <span class="badge bg-danger"><?= $demand ?></span>
            <?php else: ?>
                <span class="badge bg-secondary"><?= $demand ?></span>
            <?php endif; ?>
        </td>
        <!-- <td><?= $created_by ?></td>
        <td><?= $created_at ?></td>
        <td><?= $updated_by ?></td>
        <td><?= $updated_at ?></td> -->
        <td><?= ($status == 1) ? 'Available' : 'Not Available'; ?></td>
        <td class="text-center">
    <a href="view_images.php?id=<?= $id ?>" title="View Product Images">
        <i class="ti ti-folder" style="font-size: 24px;"></i>
    </a>
</td>

        <td>
            <a href="edit_products.php?id=<?= $id ?>" class="btn btn-sm btn-warning">Edit</a>
<a href="delete_products.php?id=<?= $id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
        </td>
    </tr>
<?php
    }
} else {
    echo "<tr><td colspan='12' class='text-center'>No products found.</td></tr>";
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center mt-4">
        <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
            </li>
        <?php endfor; ?>

        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>

<?php include __DIR__ . '/Layouts/footer.php'; ?>
<?php include __DIR__ . '/Layouts/footerlinks.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
