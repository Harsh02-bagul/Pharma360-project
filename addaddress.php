<?php
session_start();
include 'head.php';
include 'header.php';
include 'menu.php';

if (!isset($_SESSION['uid'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login.php';</script>";
    exit();
}

if (isset($_POST['btnsave'])) {
    extract($_POST);

    
    $house_no = trim($house_no);
    $street = trim($street);
    $area = trim($area);
    $landmark = trim($landmark);
    $pincode = trim($pincode);

    
    if ($pincode >= 422001 && $pincode <= 422013) {
        $full_address = "$house_no, $street, $area, Nashik - $pincode, Landmark: $landmark";

        // Secure query to prevent SQL injection
        $query = pg_query_params("INSERT INTO tbladdress(aname, uid) VALUES ($1, $2)", array($full_address, $_SESSION['uid']));
        
        if ($query) {
            echo '<div class="alert alert-success text-center">Address Added Successfully! Redirecting...</div>';
            echo '<script>setTimeout(function(){ window.location.href="address.php"; }, 2000);</script>';
        } else {
            echo '<div class="alert alert-danger text-center">Error adding address. Please try again.</div>';
        }
    } else {
        echo '<div class="alert alert-danger text-center">Invalid Pincode. Delivery is only available in Nashik.</div>';
    }
}
?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-6">
        <div class="card shadow-lg rounded">
            <div class="card-body">
                <h3 class="text-center mb-4">Add Address</h3>

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">House/Flat No.</label>
                        <input type="text" name="house_no" class="form-control" required placeholder="Enter House/Flat No.">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Street Name</label>
                        <input type="text" name="street" class="form-control" required placeholder="Enter Street Name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Area/Locality</label>
                        <input type="text" name="area" class="form-control" required placeholder="Enter Area/Locality">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control" value="Nashik" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pincode</label>
                        <input type="number" name="pincode" class="form-control" min="422001" max="422013" required placeholder="Enter Pincode">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Landmark (Optional)</label>
                        <input type="text" name="landmark" class="form-control" placeholder="Enter Landmark">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success w-100" name="btnsave">Add Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
