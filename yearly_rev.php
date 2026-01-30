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
        SELECT MONTH(order_date) AS month, SUM(total_amount) AS total_revenue
        FROM tbl_order
        WHERE YEAR(order_date) = $y
        GROUP BY MONTH(order_date)
        ORDER BY month
    ";
    $result = mysqli_query($conn, $sql);

    $revenue_by_month = array_fill(1, 12, 0);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $revenue_by_month[(int)$row['month']] = $row['total_revenue'];
        }
    }

    $all_revenues[$y] = $revenue_by_month;
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
    <title>Yearly Revenue</title>
    <style>
/* PAGE TITLE */
.page-title {
    font-size: 30px;
    font-weight: 800;
    letter-spacing: 1px;
    background: linear-gradient(90deg, #1e3c72, #2a5298);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* WRAPPER CARD */
.data-card {
    background: rgba(255, 255, 255, 0.20);
    backdrop-filter: blur(14px);
    padding: 28px;
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    overflow-x: auto;
}

/* TABLE */
.table {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(0,0,0,0.12);
}

.table thead {
    background: linear-gradient(90deg, #283e51, #4b79a1);
    color: #fff;
}

.table tbody tr td {
    font-weight: 500;
    color: #333;
}

/* Hover row effect */
.table tbody tr:hover {
    background: rgba(220,220,220,0.2);
    transition: 0.3s ease;
}

/* First column (Year) highlight */
.table tbody tr td:first-child {
    background: #f3f7ff;
    font-weight: 700;
    color: #1e3c72;
}

/* Responsive */
@media(max-width: 768px){
    .page-title {
        font-size: 24px;
    }
}
</style>

</head>

<body class="d-flex flex-column min-vh-100">

<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">

    <?php include __DIR__ . '/Layouts/header.php'; ?>
    <?php include __DIR__ . '/Layouts/sidebar.php'; ?>

    <div class="body-wrapper">
        <?php include __DIR__ . '/Layouts/header2.php'; ?>

        <div class="container-fluid mt-5">
<h3 class="page-title mb-4">Yearly Revenue (Last 5 Years)</h3>

<div class="data-card table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Year</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Apr</th>
                            <th>May</th>
                            <th>Jun</th>
                            <th>Jul</th>
                            <th>Aug</th>
                            <th>Sep</th>
                            <th>Oct</th>
                            <th>Nov</th>
                            <th>Dec</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_revenues as $year => $months): ?>
                            <tr>
                                <td><strong><?= $year ?></strong></td>
                                <?php for ($m = 1; $m <= 12; $m++): ?>
                                    <td>$<?= number_format($months[$m], 2) ?></td>
                                <?php endfor; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/Layouts/footer.php'; ?>
<?php include __DIR__ . '/Layouts/footerlinks.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
