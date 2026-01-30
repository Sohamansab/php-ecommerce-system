<?php

session_start();
include 'partials/_dbconnect.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}


if (!isset($_GET['id'])) {
    header("Location: welcome.php");
    exit;
}

$id = (int)$_GET['id'];

//fetch data
$sql = "SELECT * FROM tbl_users WHERE sno = $id";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    header("Location: welcome.php");
    exit;
}

$user = $result->fetch_assoc();
$existingFileName = $user['uploaded_file'] ?? ''; 


$error = "";
$success = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $designation = $_POST['designation'] ?? '';

    // =========================
    // FILE UPLOAD
    // =========================
    if (isset($_FILES['userFile']) && $_FILES['userFile']['error'] !== UPLOAD_ERR_NO_FILE) {

        //add id  with folder 
$userFolder = __DIR__ . "/Uploads/" . $id;
if (!is_dir($userFolder)) {
    mkdir($userFolder, 0777, true);
}


        $filename = basename($_FILES['userFile']['name']);
        $tmp_name = $_FILES['userFile']['tmp_name'];
        $fileInfo = pathinfo($filename);
        $fileType = strtolower($fileInfo['extension']);
        $maxSize = 500 * 1024; 

        $safeFilename = preg_replace("/[^A-Za-z0-9_\-\.]/", '_', $fileInfo['filename']) . '.' . $fileType;
$location = $userFolder . '/' . $safeFilename;

        if ($fileType !== 'pdf') {
            $error = "Only PDF files are allowed.";
        } elseif ($_FILES['userFile']['size'] > $maxSize) {
            $error = "File size exceeds 500KB limit.";
        } else {
            if (file_exists($location)) {
                $timestamp = date('Ymd_His');
                $newName = $fileInfo['filename'] . '_' . $timestamp . '.' . $fileType;
                rename($location, $upload_dir . $newName);
            }
//move upload file 
            if (move_uploaded_file($tmp_name, $location)) {
                $updateFileSql = "UPDATE tbl_users SET uploaded_file = '$safeFilename' WHERE sno = $id";
                if ($conn->query($updateFileSql) === FALSE) {
                    $error = "Failed to update file info in database.";
                } else {
                    $existingFileName = $safeFilename; 
                }
            } else {
                $error = "Failed to upload the file.";
            }
        }
    }

    if ($username === '' || $email === '') {
        $error = "Username and Email are required.";
    }

    // =========================
    //  UPDATE USER DATA
    // =========================
    if (!$error) {
        $updated_by = $_SESSION['username']; 

        $updateSql = "UPDATE tbl_users SET
                        username = '$username',
                        email = '$email',
                        phone = '$phone',
                        designation = '$designation',
                        updated_by = '$updated_by',
                        updated_at = NOW()
                      WHERE sno = $id";

        if ($conn->query($updateSql) === TRUE) {
            $success = "User updated successfully.";

            $result = $conn->query($sql);
            $user = $result->fetch_assoc();
        } else {
            $error = "Update failed: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Edit User</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>Edit User</h2>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

 
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" class="form-control" required />
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="form-control" required />
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" class="form-control" />
        </div>

        <div class="mb-3">
            <label>Designation</label>
            <select name="designation" class="form-select">
                <?php
                $designations = ['Student', 'Developer', 'Manager', 'Designer', 'Teacher', 'Other'];
                foreach ($designations as $d) {
                    $selected = ($user['designation'] === $d) ? 'selected' : '';
                    echo "<option value=\"$d\" $selected>$d</option>";
                }
                ?>
            </select>
        </div>

   
        <div class="mb-3">
            <label for="userFile" class="form-label">Upload File (PDF only, max 500KB):</label>
            <input type="file" name="userFile" id="userFile" class="form-control" />
            <!-- <?php if (!empty($existingFileName)): ?>
            <?php endif; ?> -->
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="manage_user.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
