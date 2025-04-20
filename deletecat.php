<?php
include 'head.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $product_check = pg_query($conn, "SELECT * FROM tblproduct WHERE cid = $id");
    if (pg_num_rows($product_check) > 0) {
        
        $product_in_orders_check = pg_query($conn, "SELECT * FROM tblorders WHERE pid IN (SELECT pid FROM tblproduct WHERE cid = $id)");

        if (pg_num_rows($product_in_orders_check) > 0) {
    
            echo "<script>alert('Cannot delete category because it has products that are part of existing orders.'); window.location.href='category.php';</script>";
        } else {
        
            $query = pg_query($conn, "DELETE FROM tblcategory WHERE cid = $id");

            if ($query) {
                echo "<script>alert('Category deleted successfully!'); window.location.href='category.php';</script>";
            } else {
                echo "<script>alert('Error deleting category: " . pg_last_error($conn) . "'); window.location.href='category.php';</script>";
            }
        }
    } else {
        
        $query = pg_query($conn, "DELETE FROM tblcategory WHERE cid = $id");

        if ($query) {
            echo "<script>alert('Category deleted successfully!'); window.location.href='category.php';</script>";
        } else {
            echo "<script>alert('Error deleting category: " . pg_last_error($conn) . "'); window.location.href='category.php';</script>";
        }
    }
} else {
    echo "<script>window.location.href='category.php';</script>";
}
?>
