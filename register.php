<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <?php include 'head.php'; ?>
</head>
<body>

<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6">
        <div class="card shadow-lg rounded">
            <div class="card-body">
                <h3 class="text-center mb-4">Register</h3>

                <?php
                if (isset($_POST['btnsave'])) {
                    extract($_POST);

                    
                    $check_email = pg_query("SELECT * FROM tbluser WHERE email='$txtemail'");
                    if (pg_num_rows($check_email) > 0) {
                        echo '<div class="alert alert-danger text-center">Email already registered! Try logging in.</div>';
                    } else {
                        $query = pg_query("INSERT INTO tbluser(firstname, lastname, email, upass, gender, phone) 
                                           VALUES ('$txtfname','$txtlname','$txtemail','$txtpass','$rbgender','$txtphone')");
                        
                        if ($query) {
                            echo '<div class="alert alert-success text-center">Registration Successful! Redirecting to login...</div>';
                            echo '<script>setTimeout(function(){ window.location.href="login.php"; }, 2000);</script>';
                        } else {
                            echo '<div class="alert alert-danger text-center">Error in Registration. Try Again.</div>';
                        }
                    }
                }
                ?>

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" required name="txtfname" placeholder="Enter first name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" required name="txtlname" placeholder="Enter last name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" required name="txtemail" placeholder="Enter email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" required name="txtpass" placeholder="Enter password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Gender</label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="rbgender" value="Male" checked>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="rbgender" value="Female">
                            <label class="form-check-label">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="rbgender" value="Other">
                            <label class="form-check-label">Other</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" pattern="\d{10}" class="form-control" required name="txtphone" placeholder="Enter 10-digit phone number">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success w-100" name="btnsave">Register</button>
                    </div>

                    <div class="text-center mt-3">
                        <p>Already have an account? <a href="login.php">Login Here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
