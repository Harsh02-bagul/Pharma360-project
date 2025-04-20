<?php
session_start();
include 'head.php';
include 'header.php';
include 'menu.php';

if (!isset($_SESSION['uid'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login.php';</script>";
    exit();
}

$uid = $_SESSION['uid'];


$q = pg_query_params("SELECT * FROM tbladdress WHERE uid = $1", array($uid));
?>

<div class="container my-4">
    <h2 class="text-center">My Addresses</h2>
    <div class="text-center">
        <a href="addaddress.php" class="btn btn-primary my-3">Add New Address</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <?php if (pg_num_rows($q) > 0) { ?>
                        <table class="table table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($r = pg_fetch_array($q)) { ?>
                                    <tr>
                                        <td><?php echo $r['aname']; ?></td>
                                        <td>
                                            <a href="bill.php?id=<?php echo $r['aid']; ?>" class="btn btn-success btn-sm">Select</a>
                                         <a href="updateaddress.php?id=<?php echo $r['aid']; ?>" class="btn btn-warning btn-sm">Update</a>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="alert alert-warning text-center">
                            No addresses found. <a href="addaddress.php" class="alert-link">Add a new address</a>.
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
