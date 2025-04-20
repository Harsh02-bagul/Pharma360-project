<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Cart</title>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'menu.php'; ?>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Your Shopping Cart</h2>
        <div class="card shadow-sm p-4">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $q = pg_query("SELECT * FROM tblproduct, tblcart WHERE tblproduct.pid = tblcart.pid  AND tblcart.uid = " . $_SESSION['uid']);
                    while ($r = pg_fetch_array($q)) {
                        $subtotal = $r['pdprice'] * $r['qty'];
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo $r['pname']; ?></td>
                        <td>₹<?php echo $r['pdprice']; ?></td>
                        <td><?php echo $r['qty']; ?></td>
                        <td>₹<?php echo $subtotal; ?></td>
                        <td>
                            <a href="delete.php?id=<?php echo $r['cartid']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total</td>
                        <td class="fw-bold">₹<?php echo $total; ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="text-end mt-3">
                <a href="address.php" class="btn btn-success">Choose Address</a>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
