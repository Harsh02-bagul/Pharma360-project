<?php
session_start();
include 'head.php';
include 'menu.php';


if (!isset($_SESSION['uid'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login.php';</script>";
    exit();
}


$uid = $_SESSION['uid'];
$q = pg_query($conn, "SELECT * FROM tbluser WHERE uid = $uid");
$user = pg_fetch_array($q);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Profile</title>
</head>
<body>

<div class="container mt-4">
    <div class="card shadow-lg border-0 p-4">
        <h2 class="text-center text-primary mb-3">My Profile</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td><strong>First Name:</strong></td>
                    <td><?php echo $user['firstname']; ?></td>
                </tr>
                <tr>
                    <td><strong>Last Name:</strong></td>
                    <td><?php echo $user['lastname']; ?></td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td><?php echo $user['email']; ?></td>
                </tr>
                <tr>
                    <td><strong>Phone:</strong></td>
                    <td><?php echo $user['phone']; ?></td>
                </tr>
                <tr>
                    <td><strong>Gender:</strong></td>
                    <td><?php echo $user['gender']; ?></td>
                </tr>
                <tr>
                    <td><strong>Actions:</strong></td>
                    <td>
                        <a href="editprofile.php" class="btn btn-warning">Edit Profile</a>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
