<?php
session_start();
// if not login 
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

include 'partials/_dbconnect.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
    <link href="https://unpkg.com/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">

  <link rel="stylesheet" href="/CRUD/assets/css/styles.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column min-vh-100">
<!-- <?php include 'partials/_nav.php'; ?> -->

<!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
<?php include __DIR__ . '/Layouts/header.php'; ?>
<?php include __DIR__ . '/Layouts/sidebar.php'; ?>

    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
<?php include __DIR__ . '/Layouts/header2.php'; ?>
   <div class="body-wrapper-inner">
        <div class="container-fluid">
          
       
        
        </div>
      </div>
      <!--  Header End -->
   
    </div>
  </div>


  <!--  Sticky Footer -->
  <?php include __DIR__ . '/Layouts/footer.php'; ?>

  <!--  JS -->
  <?php include __DIR__ . '/Layouts/footerlinks.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
