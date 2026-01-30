<?php
session_start();
include 'partials/_dbconnect.php';

$showError = false;
$emailErr = $passwordErr = $phoneErr = "";
$username = $email = $phone = $designation = "";

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST['username']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $cpassword = test_input($_POST['cpassword']);
    $phone = test_input($_POST['phone']);
    $designation = test_input($_POST['designation']);

    $valid = true;

    if (empty($email)) {
        $emailErr = "Email is required";
        $valid = false;
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i", $email)) {
        $emailErr = "Invalid email format";
        $valid = false;
    }

    if (empty($password)) {
        $passwordErr = "Password is required";
        $valid = false;
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
        $passwordErr = "Password must be at least 8 characters and include both letters and numbers.";
        $valid = false;
    } elseif ($password !== $cpassword) {
        $passwordErr = "Passwords do not match";
        $valid = false;
    }

    if (empty($phone)) {
        $phoneErr = "Phone is required";
        $valid = false;
    } 

 
    if ($valid) {
        $existsql = "SELECT * FROM tbl_users WHERE email = '$email'";
        $result = mysqli_query($conn, $existsql);
        $numExistRows = mysqli_num_rows($result);

        if ($numExistRows > 0) {
            $showError = "Email already registered";
        } else {
            $creator = $_SESSION['username'] ?? $username;
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `tbl_users` 
(`username`, `password`, `email`, `phone`, `designation`, `created_by`)
VALUES ('$username', '$password', '$email', '$phone', '$designation', '$creator')";
     $result = mysqli_query($conn, $sql);

            if ($result) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $username;

                header("Location: welcome.php");
                exit;
            } else {
                $showError = "Something went wrong while inserting.";
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SignUp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php if ($showError): ?>
  <div class="alert alert-danger text-center"><?= $showError ?></div>
<?php endif; ?>

<div class="d-flex justify-content-center">
  <form action="signup.php" method="post" class="col-12 col-md-6 col-lg-6">
    <h3 class="text-center mb-4">Sign Up</h3>

    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" required value="<?= htmlspecialchars($username) ?>">
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($email) ?>">
      <div class="text-danger"><?= $emailErr ?></div>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" required>
      <div class="text-danger"><?= $passwordErr ?></div>
    </div>

    <div class="mb-3">
      <label for="cpassword" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="cpassword" name="cpassword" required>
    </div>

    <div class="mb-3">
      <label for="phone" class="form-label">Phone</label>
      <input type="text" class="form-control" id="phone" name="phone" required value="<?= htmlspecialchars($phone) ?>">
      <div class="text-danger"><?= $phoneErr ?></div>
    </div>

    <div class="mb-3">
      <label for="designation" class="form-label">Designation</label>
      <select class="form-select" id="designation" name="designation" required>
        <option value="">-- Select Designation --</option>
        <?php
        $designations = ['Student', 'Developer', 'Manager', 'Designer', 'Teacher', 'Other'];
        foreach ($designations as $d) {
            $selected = ($designation === $d) ? 'selected' : '';
            echo "<option value=\"$d\" $selected>$d</option>";
        }
        ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <p>Already have an account? <a href="login.php">Login here</a></p>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
