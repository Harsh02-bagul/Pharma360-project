<?php
include 'head.php'; 

if (isset($_GET['id'])) {
    $did = $_GET['id']; 

    
    $query = "DELETE FROM tbldoctor WHERE did = '$did'";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "<script>alert('Doctor Deleted Successfully!'); window.location.href='manage_doctors.php';</script>";
    } else {
        echo "<script>alert('Error deleting doctor.'); window.location.href='manage_doctors.php';</script>";
    }
} else {
    echo "<script>alert('Invalid Request!'); window.location.href='manage_doctors.php';</script>";
}
?>
