<?php
session_start();
include 'partials/_dbconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$error = $success = '';
$username = $email = $phone = $designation = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $phone = trim($_POST['phone']);
    $designation = $_POST['designation'];

    if (!$username || !$email || !$password || !$designation) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email.";
    } else {
        $uploadedFile = '';
        if (isset($_FILES['userFile']) && $_FILES['userFile']['error'] == 0) {
            $uploadDir = __DIR__ . '/Uploads/';
            $fileInfo = pathinfo($_FILES['userFile']['name']);
            $ext = strtolower($fileInfo['extension']);
            $safeName = preg_replace("/[^A-Za-z0-9_\-]/", '_', $fileInfo['filename']);
            $fileName = $safeName . '_' . time() . '.' . $ext;

            if ($ext !== 'pdf') {
                $error = "Only PDF files allowed.";
            } elseif ($_FILES['userFile']['size'] > 500 * 1024) {
                $error = "File too large (max 500KB).";
            } elseif (!move_uploaded_file($_FILES['userFile']['tmp_name'], $uploadDir . $fileName)) {
                $error = "File upload failed.";
            } else {
                $uploadedFile = $fileName;
            }
        }

        if (!$error) {
            $createdBy = $_SESSION['username'];

            $sql = "INSERT INTO tbl_users
                    (username, password, email, phone, designation, created_by, uploaded_file)
                    VALUES ('$username', '$password', '$email', '$phone', '$designation', '$createdBy', '$uploadedFile')";

            if (mysqli_query($conn, $sql)) {
    $userId = mysqli_insert_id($conn); 

  // User id folder

    $userFolder = __DIR__ . "/Uploads/" . $userId;
    if (!is_dir($userFolder)) {
        mkdir($userFolder, 0777, true);
    }

    if (!empty($uploadedFile)) {
        rename($uploadDir . $uploadedFile, $userFolder . '/' . $uploadedFile);
// Update it from db
        $updatePathSql = "UPDATE tbl_users SET uploaded_file = '$userId/$uploadedFile' WHERE sno = $userId";
        mysqli_query($conn, $updatePathSql);
    }

    $success = "User added successfully.";
    $username = $email = $phone = $designation = '';
}

            } else {
                $error = "Failed to insert: " . mysqli_error($conn);
            }
        }
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
<?php include('./Layouts/header.php');?>
<?php include('./Layouts/sidebar.php');?>

    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
<?php include('./Layouts/header2.php');?>
   <div class="body-wrapper-inner">
        <div class="container-fluid">
          
<div class="container mt-4">
  <h3>Add New User</h3>

  <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
  <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Username</label>
      <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($username) ?>" >
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" >
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" >
    </div>
    <div class="mb-3">
      <label>Phone</label>
      <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($phone) ?>">
    </div>
    <div class="mb-3">
      <label>Designation</label>
      <select name="designation" class="form-select" >
        <option value="">Select</option>
        <?php
        foreach (['Student', 'Developer', 'Manager', 'Designer', 'Teacher', 'Other'] as $d) {
            $selected = ($designation === $d) ? 'selected' : '';
            echo "<option value='$d' $selected>$d</option>";
        }
        ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Upload File (PDF, max 500KB)</label>
      <input type="file" name="userFile" class="form-control" accept="application/pdf">
    </div>
    <button type="submit" class="btn btn-primary">Add User</button>
    <a href="manage_user.php" class="btn btn-secondary">Back</a>
  </form>
</div>
          
       
        <?php include('./Layouts/footer.php');?>
        
        </div>
      </div>
      <!--  Header End -->
   
    </div>
  </div>
        <?php include('./Layouts/footerlinks.php');?>


<script>
  window.addEventListener('pageshow', function (event) {
    if (event.persisted || window.performance.navigation.type === 2) {
      window.location.reload();
    }
  });
</script>

        
</body>

</html>












