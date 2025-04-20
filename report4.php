<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yearly Orders Report</title>
    <?php include 'head.php'; ?>
</head>
<body>

<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Yearly Orders Report</h2>
    
    <form method="post">
        <table class="table">
            <tr>
                <td>Choose Year</td>
                <td>
                    <select name="cmbyear" class="form-control">
                        <option>2024</option>
                        <option>2025</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="btnshow" class="btn btn-primary">Show Report</button>
                </td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['btnshow'])) {
        $cmbyear = $_POST['cmbyear'];
        $total_amount = 0;

        echo "<h3 class='text-center text-primary'>Order Report for Year $cmbyear</h3>";

        $query = "SELECT tblproduct.pname, tblorders.qty, tblorders.price, tblorders.total, 
                         tblorders.delivery_charges, tblorders.order_date 
                  FROM tblorders 
                  INNER JOIN tblproduct ON tblorders.pid = tblproduct.pid 
                  WHERE EXTRACT(YEAR FROM tblorders.order_date) = '$cmbyear' 
                  AND tblorders.paid = 1 
                  AND tblorders.status = 'Delivered'";

        $result = pg_query($query);

        if (!$result) {
            die("<div class='alert alert-danger'>SQL Error: " . pg_last_error() . "</div>");
        }

        if (pg_num_rows($result) == 0) {
            echo "<div class='alert alert-warning'>No records found for the selected year.</div>";
        } else {
    ?>

    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Delivery Charges</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

        <?php
        while ($row = pg_fetch_array($result)) {
            $subtotal = $row['price'] * $row['qty'];
            $grand_total = $subtotal + $row['delivery_charges'];
            $total_amount += $grand_total;
        ?>

            <tr>
                <td><?php echo $row['pname']; ?></td>
                <td>₹<?php echo number_format($row['price'], 2); ?></td>
                <td><?php echo $row['qty']; ?></td>
                <td>₹<?php echo number_format($subtotal, 2); ?></td>
                <td>₹<?php echo number_format($row['delivery_charges'], 2); ?></td>
                <td>₹<?php echo number_format($grand_total, 2); ?></td>
            </tr>

        <?php
        }
        ?>

        <tr>
            <td colspan="5"><strong>Total Amount</strong></td>
            <td><strong>₹<?php echo number_format($total_amount, 2); ?></strong></td>
        </tr>

        </tbody>
    </table>

    <?php
        }
    }
    ?>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
