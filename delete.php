<?php
include 'partials/_dbconnect.php';

if (isset($_GET['sno'])) {
    $sno = (int)$_GET['sno']; 

    $sql = "DELETE FROM tbl_users WHERE sno = $sno";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_user.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: manage_user.php");
    exit;
}
?>
