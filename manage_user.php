<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

include 'partials/_dbconnect.php';
$sql = "SELECT * FROM tbl_users ORDER BY sno  DESC ";

//pagination 
$records_per_page = 10;

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

$start_from = ($page - 1) * $records_per_page;

$total_records_query = "SELECT COUNT(*) AS total FROM tbl_users";
$total_records_result = mysqli_query($conn, $total_records_query);
$total_records = mysqli_fetch_assoc($total_records_result)['total'];
$total_pages = ceil($total_records / $records_per_page);

$sql = "SELECT * FROM tbl_users ORDER BY sno DESC LIMIT $start_from, $records_per_page";
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
    <title>Manage Users</title>

  <style>
/* MAIN CONTENT SPACING */
.content-wrapper {
    padding-top: 40px !important;
}

/* CARD STYLE WRAPPER */
.table-container {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(12px);
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* TABLE */
.table {
    border-radius: 10px;
    overflow: hidden;
}

/* HEADER ROW */
.table thead tr {
    background: linear-gradient(90deg, #2c3e50, #4b79a1);
    color: #fff;
}

/* ROW HOVER */
.table tbody tr:hover {
    background: #f1f1f1;
    transform: scale(1.01);
    transition: 0.2s ease-in-out;
}

/* BUTTONS */
.btn-primary {
    background: linear-gradient(90deg, #4b79a1, #283e51);
    border: none;
    padding: 8px 18px;
    border-radius: 6px;
    font-size: 15px;
}

.btn-warning,
.btn-danger {
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: 600;
}

/* DOWNLOAD ICON */
.ti-download {
    font-size: 20px;
    color: #2c3e50;
    transition: 0.2s;
}
.ti-download:hover {
    transform: translateY(-3px);
    color: #4b79a1;
}

/* PAGE TITLE */
.page-title {
    font-size: 26px;
    font-weight: 700;
    letter-spacing: .5px;
}

/* PAGINATION */
.pagination .page-link {
    border-radius: 6px;
    margin: 0 4px;
    border: none;
    padding: 8px 14px;
    font-size: 15px;
    color: #333;
}
.pagination .page-item.active .page-link {
    background: linear-gradient(90deg, #4b79a1, #283e51);
    color: #fff;
}
.pagination .page-link:hover {
    background: #ddd;
}

/* ADD USER BUTTON */
.add-btn {
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
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
        <div class="container-fluid content-wrapper ">
            <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
              <h3 class="mb-0 page-title">Manage Users</h3>
<a href="add_user.php" class="btn btn-primary add-btn">+ Add User</a>

            </div>

<div class="table-container table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Designation</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Updated By</th>
                            <th>Updated At</th>
                            <th>Download</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sno = $row['sno'];
                                $username = htmlspecialchars($row['username']);
                                $email = htmlspecialchars($row['email']);
                                $phone = htmlspecialchars($row['phone']);
                                $designation = htmlspecialchars($row['designation']);
                                $created_by = htmlspecialchars($row['created_by'] ?? 'N/A');
                                $created_at = htmlspecialchars($row['created_at'] ?? 'N/A');
                                $updated_by = htmlspecialchars($row['updated_by'] ?? 'N/A');
                                $updated_at = htmlspecialchars($row['updated_at'] ?? 'N/A');
                                $uploaded_file = $row['uploaded_file'] ?? '';
                                ?>
                                <tr>
                                    <td><?= $sno ?></td>
                                    <td><?= $username ?></td>
                                    <td><?= $email ?></td>
                                    <td><?= $phone ?></td>
                                    <td><?= $designation ?></td>
                                    <td><?= $created_by ?></td>
                                    <td><?= $created_at ?></td>
                                    <td><?= $updated_by ?></td>
                                    <td><?= $updated_at ?></td>
                                    <td>
                                        <?php if (!empty($uploaded_file)): ?>
                                            <a href="Uploads/<?= htmlspecialchars($uploaded_file) ?>" download>
                                                <i class="ti ti-download"></i>
                                            </a>
                                        <?php else: ?>
                                            No File
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit.php?id=<?= $sno ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete.php?sno=<?= $sno ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='11' class='text-center'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div> 
</div> 
<!-- Pagination  -->
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
