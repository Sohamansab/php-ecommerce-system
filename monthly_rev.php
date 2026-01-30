<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

include 'partials/_dbconnect.php';

$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

$sql = "
    SELECT MONTH(order_date) AS month, SUM(total_amount) AS total_revenue
    FROM tbl_order
    WHERE YEAR(order_date) = $year
    GROUP BY MONTH(order_date)
    ORDER BY month
";
$result = mysqli_query($conn, $sql);

$revenue_by_month = array_fill(1, 12, 0);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $month = (int)$row['month'];
        $revenue_by_month[$month] = $row['total_revenue'];
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
    <title>Revenue by Month</title>
    <style>
/* PAGE TITLE */
.page-title {
    font-size: 28px;
    font-weight: 700;
    background: linear-gradient(90deg, #2c3e50, #4b79a1);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: 1px;
}

/* WRAPPER CARD */
.data-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(12px);
    padding: 25px;
    border-radius: 14px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    margin-top: 20px;
}

/* TABLE */
.table {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(0,0,0,0.1);
}

/* TABLE HEADER */
.table thead {
    background: linear-gradient(90deg, #4b79a1, #283e51);
    color: #fff;
}

.table tbody tr:hover {
    background: #f7f7f7;
    transform: scale(1.01);
    transition: 0.2s ease-in-out;
}

/* YEAR DROPDOWN */
.year-select {
    width: 120px;
    border-radius: 8px;
    border: 1px solid #aaa;
    padding: 6px 8px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
}

/* CONTAINER SPACING */
.container-fluid {
    padding-top: 40px;
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
            <div class="d-flex justify-content-between align-items-center mb-3">
<h3 class="page-title">Revenue By Month</h3>
            </div>

          <form method="GET">
<select name="year" onchange="this.form.submit()" class="form-select year-select">
        <?php 
        $current_year = date('Y');
        for ($y = $current_year; $y >= $current_year - 5; $y--) {
            $selected = ($year == $y) ? 'selected' : '';
            echo "<option value='$y' $selected>$y</option>";
        }
        ?>
    </select>
</form>


<div class="data-card table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-dark">
                        <tr>
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
                        <tr>
                            <?php for ($m = 1; $m <= 12; $m++): ?>
                                <td>$<?= number_format($revenue_by_month[$m], 2) ?></td>
                            <?php endfor; ?>
                        </tr>
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
