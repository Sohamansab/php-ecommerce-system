<?php
include 'partials/_dbconnect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    $sql = "DELETE FROM tbl_products WHERE product_id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_products.php?msg=deleted");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: manage_products.php?msg=invalid");
    exit;
}
?>
