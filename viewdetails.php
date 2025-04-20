<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product Details</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'menu.php'; ?>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <?php
            $q = pg_query("select * from tblproduct where pid=" . $_GET['id']);
            $r = pg_fetch_array($q);
            ?>
            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <img src="admin/<?php echo $r['pimage']; ?>" class="card-img-top" alt="Product Image" style="width: 100%; height: 300px; object-fit: contain;">
                    <div class="card-body">
                        <h3 class="card-title text-center"> <?php echo $r['pname']; ?> </h3>
                        <p class="text-center text-muted"><strike>₹<?php echo $r['pprice']; ?></strike></p>
                        <p class="text-center fw-bold text-success">₹<?php echo $r['pdprice']; ?></p>
                        <p><strong>Description:</strong> <?php echo $r['pdesc']; ?></p>
                        <p><strong>Product Video:</strong> <?php echo $r['pvideo']; ?></p>
                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label">Enter Quantity</label>
                                <input type="number" name="cmbqty" class="form-control" min="1" required>
                            </div>
                            <button type="submit" name="btnaddcart" class="btn btn-primary w-100">Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST["btnaddcart"])) {
        extract($_POST);
        $ddate = date('Y-m-d');
        $ttime = date('H:i:s');
        $q1 = pg_query("select * from tblproduct where pid=" . $_GET['id']);
        $r1 = pg_fetch_array($q1);
        $newstock = $r1['pstock'] - $cmbqty;
        if ($newstock > 0) {
            pg_query("INSERT INTO tblcart(uid, pid, qty, ddate, ttime, status) VALUES ('" . $_SESSION['uid'] . "','" . $_GET['id'] . "','$cmbqty','$ddate','$ttime','Pending')");
            pg_query("update tblproduct set pstock='$newstock' where pid=" . $_GET['id']);
            echo "<script>alert('".$r['pname']." added to cart successfully!'); window.location='viewcart.php';</script>";
        } else {
            echo "<script>alert('Out Of Stock');</script>";
        }
    }
    ?>

    <?php include 'footer.php'; ?>
</body>
</html>
