<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <?php include 'head.php'; ?>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5">
        <div class="card shadow-lg rounded">
            <div class="card-body">
                <h3 class="text-center mb-4">Admin Panel</h3>

                <?php
                session_start();
                if (isset($_POST['btnlogin'])) {
                    extract($_POST);

                    $txtemail = trim($txtemail);
                    $txtpass = trim($txtpass);

                    // Secure query to prevent SQL injection
                    $q = pg_query_params("SELECT * FROM tbladmin WHERE aemail=$1 AND apass=$2", array($txtemail, $txtpass));

                    if (pg_num_rows($q) > 0) {
                        $_SESSION['admin_email'] = $txtemail;
                        echo '<script>window.location.href="admin_home.php";</script>';
                    } else {
                        echo '<div class="alert alert-danger text-center">Invalid Credentials! Please try again.</div>';
                    }
                }
                ?>

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="txtemail" required placeholder="Enter Admin Email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="txtpass" required placeholder="Enter Password">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success w-100" name="btnlogin">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
