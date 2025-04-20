<?php
session_start();
include 'head.php';
include 'menu.php';
include 'db_connect.php';


if (!isset($_SESSION['uid'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login.php';</script>";
    exit();
}


$uid = $_SESSION['uid'];
$q = pg_query($conn, "SELECT * FROM tbluser WHERE uid = $uid");
$user = pg_fetch_array($q);

if (isset($_POST['btnupdate'])) {
    $fname = pg_escape_string($conn, $_POST['firstname']);
    $lname = pg_escape_string($conn, $_POST['lastname']);
    $phone = pg_escape_string($conn, $_POST['phone']);
    $gender = pg_escape_string($conn, $_POST['gender']);
    $email = pg_escape_string($conn, $_POST['email']);

    pg_query($conn, "UPDATE tbluser SET firstname='$fname', lastname='$lname', phone='$phone', gender='$gender', email='$email' WHERE uid = $uid");
    echo "<script>alert('Profile Updated Successfully!'); window.location.href='profile.php';</script>";
}


if (isset($_POST['btnchange'])) {
    $oldpass = pg_escape_string($conn, $_POST['oldpass']);
    $newpass = pg_escape_string($conn, $_POST['newpass']);
    $confpass = pg_escape_string($conn, $_POST['confpass']);

    $q = pg_query($conn, "SELECT upass FROM tbluser WHERE uid = $uid");
    $user = pg_fetch_array($q);

    if ($user['upass'] == $oldpass) {
        if ($newpass == $confpass) {
            pg_query($conn, "UPDATE tbluser SET upass = '$newpass' WHERE uid = $uid");
            echo "<script>alert('Password Changed Successfully!'); window.location.href='profile.php';</script>";
        } else {
            echo "<script>alert('New Password and Confirm Password do not match!');</script>";
        }
    } else {
        echo "<script>alert('Old Password is incorrect!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Profile</title>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Edit Profile</h2>
    <form method="post">
        <table class="table">
            <tr>
                <td>First Name:</td>
                <td><input type="text" name="firstname" class="form-control" value="<?php echo $user['firstname']; ?>" required></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><input type="text" name="lastname" class="form-control" value="<?php echo $user['lastname']; ?>" required></td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td><input type="text" name="phone" class="form-control" value="<?php echo $user['phone']; ?>" required></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td>
                    <select name="gender" class="form-control" required>
                        <option value="Male" <?php echo ($user['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($user['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?php echo ($user['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <button type="submit" name="btnupdate" class="btn btn-success">Update Profile</button>
                </td>
            </tr>
        </table>
    </form>

    <h2 class="text-center mt-4">Change Password</h2>
    <form method="post">
        <table class="table">
            <tr>
                <td>Old Password:</td>
                <td><input type="password" name="oldpass" class="form-control" required></td>
            </tr>
            <tr>
                <td>New Password:</td>
                <td><input type="password" name="newpass" class="form-control" required></td>
            </tr>
            <tr>
                <td>Confirm New Password:</td>
                <td><input type="password" name="confpass" class="form-control" required></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <button type="submit" name="btnchange" class="btn btn-danger">Change Password</button>
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
