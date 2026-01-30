<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: welcome.php");
    exit;
}


$login = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';  

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM tbl_users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        session_start();
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin_loggedin'] = true;
        $_SESSION['admin_email'] = $email;
        $_SESSION['username'] = $row['username'];

        // Also set user_loggedin so they can use cart functionality
        $_SESSION['user_loggedin'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $row['sno'];

        header("location: welcome.php");
        exit;
    } else {
        $showError = "Invalid Credentials!";
    }
}
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>

    <?php
    if($login)
  {
     echo  '<div class="alert alert-success" role="alert">
 You are logged in  
</div>

';}
 if($showError)
  {
     echo  '<div class="alert alert-danger" role="alert">
  '.$showError.'  
</div>

';}
?>

<div class="d-flex justify-content-center">
 
  <form action="/CRUD/login.php" method="post" class="col-12 col-md-6 col-lg-6">
     <h1 class="text-center mb-4 mt-5">Login</h1>
    
  

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>

    

    <button type="submit" class="btn btn-primary">Login</button>
      <p>Don't have an account? <a href="signup.php">Sign up here</a></p>


  </form>
 
</div>

   
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>