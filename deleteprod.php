<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'head.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Check if product exists in orders
    $check_query = pg_query("SELECT COUNT(*) FROM tblorders WHERE pid = $id");
    $count = pg_fetch_result($check_query, 0, 0);

    if ($count > 0) {
        echo "<script>alert('Cannot delete product. It is referenced in orders.'); window.location.href='product.php';</script>";
    } else {
        $query = pg_query("DELETE FROM tblproduct WHERE pid = $id");

        if ($query) {
            echo "<script>alert('Product deleted successfully!'); window.location.href='product.php';</script>";
        } else {
            echo "<script>alert('Error deleting product: " . pg_last_error() . "'); window.location.href='product.php';</script>";
        }
    }
} else {
    echo "<script>alert('Invalid product ID!'); window.location.href='product.php';</script>";
}
?>
