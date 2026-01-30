<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

include 'partials/_dbconnect.php';

$current_year = date('Y');
$start_year = $current_year - 4;
$all_revenues = [];

for ($y = $current_year; $y >= $start_year; $y--) {
    $sql = "
        SELECT c.id, c.name, COALESCE(SUM(o.total_amount), 0) AS total_revenue
        FROM categories c
        LEFT JOIN tbl_products p ON c.id = p.category_id
        LEFT JOIN tbl_order_item oi ON p.product_id = oi.id_item
        LEFT JOIN tbl_order o ON oi.order_id = o.order_id AND YEAR(o.order_date) = $y
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

    $all_revenues[$y] = $revenue_by_category;
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
    <title>Revenue by Category & Year</title>
    <style>
    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #2d2d2d;
    }

    .card-custom {
        padding: 30px;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 4px 25px rgba(0,0,0,0.07);
        animation: fadeIn 0.5s ease-in-out;
    }

    .table thead {
        background: linear-gradient(90deg, #1a1a1a, #444);
        color: #fff;
        font-size: 15px;
        letter-spacing: .5px;
    }

    .table tbody tr:hover {
        background: #f5f5f5;
        transition: 0.25s;
    }

    .table td, .table th {
        padding: 16px;
    }

    .revenue {
        font-weight: 700;
        color: #198754;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
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
            <h3 class="page-title">📊 Revenue by Category & Year (Last 5 Years)</h3>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th style="text-align: left; padding-left: 20px;">Category</th>
                        <?php for ($y = $current_year; $y >= $start_year; $y--): ?>
                            <th><?= $y ?></th>
                        <?php endfor; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $categories = [];
                    foreach ($all_revenues as $year => $cats) {
                        foreach ($cats as $cat) {
                            $categories[$cat['id']] = $cat['name'];
                        }
                    }

                    foreach ($categories as $cat_id => $cat_name): ?>
                        <tr>
                            <td style="text-align: left; padding-left: 20px;">
                                <strong><?= htmlspecialchars($cat_name) ?></strong>
                            </td>

                            <?php for ($y = $current_year; $y >= $start_year; $y--): ?>
                                <td class="revenue">
                                    <?php
                                    $revenue = 0;
                                    foreach ($all_revenues[$y] as $cat) {
                                        if ($cat['id'] == $cat_id) {
                                            $revenue = $cat['total_revenue'];
                                            break;
                                        }
                                    }
                                    echo "$" . number_format($revenue, 2);
                                    ?>
                                </td>
                            <?php endfor; ?>
                        </tr>
                    <?php endforeach; ?>
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
