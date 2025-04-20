<?php
session_start();
include 'head.php';


if (!isset($_SESSION['uid'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login.php';</script>";
    exit();
}

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid request.'); window.location.href='address.php';</script>";
    exit();
}

$aid = (int) $_GET['id']; 
$uid = (int) $_SESSION['uid'];


$checkQuery = pg_query_params($conn, "SELECT * FROM tbladdress WHERE aid = $1 AND uid = $2", array($aid, $uid));

if (!$checkQuery) {
    die("Error fetching address: " . pg_last_error($conn));
}

if (pg_num_rows($checkQuery) > 0) {
    $addressData = pg_fetch_assoc($checkQuery);
} else {
    echo "<script>alert('Address not found.'); window.location.href='address.php';</script>";
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_address = trim($_POST['address']); 

    if (!empty($new_address)) {
        $updateQuery = pg_query_params($conn, "UPDATE tbladdress SET aname = $1 WHERE aid = $2 AND uid = $3", array($new_address, $aid, $uid));

        if ($updateQuery) {
            echo "<script>alert('Address updated successfully!'); window.location.href='address.php';</script>";
        } else {
            die("Error updating address: " . pg_last_error($conn));
        }
    } else {
        echo "<script>alert('Address cannot be empty.');</script>";
    }
}
?>


<div class="container my-4">
    <h2 class="text-center">Update Address</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="address" class="form-label">New Address:</label>
                            <textarea class="form-control" name="address" id="address" required><?php echo htmlspecialchars($addressData['aname']); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Address</button>
                        <a href="address.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
