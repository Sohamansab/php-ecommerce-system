<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

include 'partials/_dbconnect.php';

$sql = "
    SELECT c.id, c.name, COALESCE(SUM(o.total_amount), 0) AS total_revenue
    FROM categories c
    LEFT JOIN tbl_products p ON c.id = p.category_id
    LEFT JOIN tbl_order_item oi ON p.product_id = oi.id_item
    LEFT JOIN tbl_order o ON oi.order_id = o.order_id
    GROUP BY c.id, c.name
    ORDER BY total_revenue DESC


";
$result = mysqli_query($conn, $sql);

$revenue_by_category = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $revenue_by_category[] = $row;
    }
}
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
    <title>Revenue by Category</title>
    <style>
    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #333;
    }

    .card-custom {
        padding: 25px;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        animation: fadeIn 0.6s ease-in-out;
    }

    .table thead {
        background: linear-gradient(90deg, #111, #444);
        color: #fff;
    }

    .table tbody tr:hover {
        background: #f6f6f6;
        transition: 0.2s;
    }

    .table td, .table th {
        padding: 15px;
        font-size: 15px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

</head>

<body class="d-flex flex-column min-vh-100">

<div class="page-wrapper" id="main-wrapper" data-layout="vertical"
     data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">

    <?php include __DIR__ . '/Layouts/header.php'; ?>
    <?php include __DIR__ . '/Layouts/sidebar.php'; ?>

    <div class="body-wrapper">
        <?php include __DIR__ . '/Layouts/header2.php'; ?>

      <div class="container-fluid mt-5">
    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="page-title">📊 Revenue By Category</h3>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 60%">Category</th>
                        <th class="text-center">Total Revenue</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($revenue_by_category)): ?>
                        <?php foreach ($revenue_by_category as $cat): ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($cat['name']) ?></strong>
                                </td>
                                <td class="text-center fw-bold text-success">
                                    $<?= number_format($cat['total_revenue'], 2) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center text-muted py-4">
                                No revenue data available
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

    </div>
</div>

<?php include __DIR__ . '/Layouts/footer.php'; ?>
<?php include __DIR__ . '/Layouts/footerlinks.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
