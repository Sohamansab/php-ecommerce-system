<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: home.php");
    exit;
}

$login = false;
$showError = false;

if (isset($_GET['redirect'])) {
    $_SESSION['redirect_after_login'] = urldecode($_GET['redirect']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM tbl_users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

$_SESSION['user_loggedin'] = true;
    $_SESSION['email'] = $row['email'];
    $_SESSION['username'] = $row['username'];
$_SESSION['user_id'] = $row['sno'];

    if (isset($_SESSION['redirect_after_login'])) {
        $redirectUrl = $_SESSION['redirect_after_login'];
        unset($_SESSION['redirect_after_login']);
        header("Location: $redirectUrl");
        exit;
    } else {
        header("Location: home.php");
        exit;
    }
}

    } else {
        $showError = "Invalid Credentials!";
    }

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }
    .h-custom {
      height: calc(100% - 73px);
    }
    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }
  </style>
</head>
<body>

<?php if ($showError): ?>
  <div class="alert alert-danger text-center m-3"><?= $showError ?></div>
<?php elseif ($login): ?>
  <div class="alert alert-success text-center m-3">You are logged in</div>
<?php endif; ?>

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">

      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="/CRUD/Layouts/assets/images/backgrounds/ecom.jpg"
             class="img-fluid rounded" alt="E-commerce login image">
      </div>

      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="" method="POST">

          <div class="form-outline mb-4">
            <input type="email" id="email" name="email" class="form-control form-control-lg"
                   placeholder="Enter a valid email address" required />
            <label class="form-label" for="email">Email address</label>
          </div>

          <div class="form-outline mb-3">
            <input type="password" id="password" name="password" class="form-control form-control-lg"
                   placeholder="Enter password" required />
            <label class="form-label" for="password">Password</label>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" id="rememberMe" />
              <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <a href="#" class="text-body">Forgot password?</a>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?
              <a href="signup.php" class="link-danger">Register</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
