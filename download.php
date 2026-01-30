<?php

session_start();

include 'partials/_dbconnect.php';


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request.");
}

$id = (int)$_GET['id'];


$sql = "SELECT uploaded_file FROM tbl_users WHERE sno = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("User not found.");
}

$row = mysqli_fetch_assoc($result);
$filename = $row['uploaded_file'];


if (empty($filename)) {
    die("No file uploaded.");
}

$filepath = __DIR__ . '/Uploads/' . $filename;

if (!file_exists($filepath)) {
    die("File not found.");
}


header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
readfile($filepath);
exit;
?>
