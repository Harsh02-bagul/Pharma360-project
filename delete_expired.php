<?php
include 'head.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    pg_query("DELETE FROM tblproduct WHERE pid = $id");
    echo "<script>alert('Expired medicine deleted successfully!'); window.location.href='expired_medicines.php';</script>";
} else {
    echo "<script>alert('Invalid request'); window.location.href='expired_medicines.php';</script>";
}
?>
