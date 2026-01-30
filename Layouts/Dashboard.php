<?php
session_start();





if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../form_login/form.php");
    exit;
}


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flexy Free Bootstrap Admin Template by WrapPixel</title>
  <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>

<body class="d-flex flex-column min-vh-100">
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
<?php include('header.php');?>
<?php include('sidebar.php');?>

    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
<?php include('header2.php');?>
   <div class="body-wrapper-inner">
        <div class="container-fluid">
          <?php
foreach ($categories as $cat) {
    echo "<div>";
    echo "<h2>{$cat['name']}</h2>";
    echo "<img src='/CRUD/cat_images/{$cat['category_image']}' alt='{$cat['name']}' width='200'>";
    echo "</div>";
}
?>

       
        <?php include('footer.php');?>
        
        </div>
      </div>
      <!--  Header End -->
   
    </div>
  </div>
        <?php include('footerlinks.php');?>


<script>
  window.addEventListener('pageshow', function (event) {
    if (event.persisted || window.performance.navigation.type === 2) {
      window.location.reload();
    }
  });
</script>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/dist/simplebar.min.js"></script>
<script src="assets/js/sidebarmenu.js"></script>


        
</body>

</html>