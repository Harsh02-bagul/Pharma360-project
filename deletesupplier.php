<?php
include 'head.php'; 

if (isset($_GET['id'])) {
    $sid = $_GET['id']; 

    
    $query = "DELETE FROM tblsupplier WHERE sid = '$sid'";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "<script>alert('Supplier Deleted Successfully!'); window.location.href='manage_suppliers.php';</script>";
    } else {
        echo "<script>alert('Error deleting supplier.'); window.location.href='manage_suppliers.php';</script>";
    }
} else {
    echo "<script>alert('Invalid Request!'); window.location.href='manage_suppliers.php';</script>";
}
?>
