<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <?php include 'head.php'; ?>
</head>
<body>

<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5">
        <div class="card shadow-lg rounded">
            <div class="card-body">
                <h3 class="text-center mb-4">Login</h3>

                <?php
                session_start(); 

                if (isset($_POST['btnlogin'])) {
                    extract($_POST);
                    $q = pg_query("SELECT * FROM tbluser WHERE email='$txtemail' AND upass='$txtpass'");
                    
                    if (pg_num_rows($q) > 0) {
                        $_SESSION['email'] = $txtemail;
                        $r1 = pg_fetch_array($q);
                        $_SESSION['fname'] = $r1['firstname'];
                        $_SESSION['uid'] = $r1['uid'];
                        $_SESSION['lname'] = $r1['lastname'];
                        $_SESSION['uphone'] = $r1['phone'];
                        echo '<script>window.location.href="welcome.php";</script>';
                    } else {
                        echo '<div class="alert alert-danger text-center">Invalid Credentials! Please try again.</div>';
                    }
                }
                ?>

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" required name="txtemail" placeholder="Enter your email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" required name="txtpass" placeholder="Enter your password">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success w-100" name="btnlogin">Login</button>
                    </div>

                    <div class="text-center mt-3">
                        <p>Don't have an account? <a href="register.php">Register Here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
