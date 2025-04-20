<?php
session_start();
include 'head.php';


if (!isset($_SESSION['uid'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login.php';</script>";
    exit();
}

if (isset($_GET['id'])) {
    $aid = (int) $_GET['id']; 
    $uid = (int) $_SESSION['uid']; 

    
    $checkQuery = pg_query_params($conn, "SELECT * FROM tbladdress WHERE aid = $1 AND uid = $2", array($aid, $uid));

    if (!$checkQuery) {
        die("Error checking address: " . pg_last_error($conn));
    }

    if (pg_num_rows($checkQuery) > 0) {
        // Attempt to delete the address
        $deleteQuery = pg_query_params($conn, "DELETE FROM tbladdress WHERE aid = $1 AND uid = $2", array($aid, $uid));

        if ($deleteQuery) {
            echo "<script>alert('Address deleted successfully!'); window.location.href='address.php';</script>";
        } else {
            // Debugging: Show exact PostgreSQL error
            die("Error deleting address: " . pg_last_error($conn));
        }
    } else {
        echo "<script>alert('Address not found or already deleted.'); window.location.href='address.php';</script>";
    }
}
?>
