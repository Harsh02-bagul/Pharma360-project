<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Summary</title>
    <?php include 'head.php';?>
</head>
<body>
    <?php include 'header.php';?>
    <?php include 'menu.php';?>

    <?php
   if (isset($_POST['btnCancelRequest'])) {
    $order_date = $_POST['order_date'];

    $check_status = pg_query("SELECT status, cancel_request FROM tblorders WHERE order_date = '$order_date'");
    $order = pg_fetch_assoc($check_status);

    if ($order['status'] == "Out For Delivery" || $order['status'] == "Delivered") {
        echo "<script>alert('Cancellation not allowed as the order is Out For Delivery or Delivered.'); window.location.href='orders.php';</script>";
    } elseif ($order['cancel_request'] === 't') {
        echo "<script>alert('Cancellation request already submitted.'); window.location.href='orders.php';</script>";
    } else {
        pg_query("UPDATE tblorders SET cancel_request = TRUE WHERE order_date = '$order_date'");
        echo "<script>alert('Cancellation request submitted. If payment was done, you will receive a refund within 2-3 days.'); window.location.href='orders.php';</script>";
    }
}
    ?>

    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h2 class="text-center mb-4 text-primary">Order Summary</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover  text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Cancellation Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $prev_order_date = null;
                        $order_total = 0;
                        $delivery_charges = 0;
                        $q = pg_query("SELECT o.order_date, p.pname, o.price, o.qty, (o.price * o.qty) AS total, 
                                              o.status, o.paid, o.cancel_request, o.delivery_charges 
                                       FROM tblorders o
                                       INNER JOIN tblproduct p ON o.pid = p.pid 
                                       WHERE o.uid = " . $_SESSION['uid'] . " 
                                       ORDER BY o.order_date DESC");
                        
                        while ($r = pg_fetch_array($q)) {
                            $show_order_info = ($prev_order_date !== $r['order_date']);
                            
                            if ($show_order_info) {
                                if ($prev_order_date !== null) {
                                    echo "<tr >
                                            <td colspan='3' class='text-end fw-bold'>Subtotal</td>
                                            <td class='fw-bold'>₹$order_total</td>
                                            <td colspan='4'></td>
                                        </tr>
                                        <tr>
                                            <td colspan='3' class='text-end fw-bold'>Delivery Charges</td>
                                            <td class='fw-bold'>₹$delivery_charges</td>
                                            <td colspan='4'></td>
                                        </tr>
                                        <tr class='table-secondary'>
                                            <td colspan='3' class='text-end fw-bold'>Grand Total</td>
                                            <td class='fw-bold text-primary'>₹" . ($order_total + $delivery_charges) . "</td>
                                            <td colspan='4'></td>
                                        </tr>
                                        <tr><td colspan='8'><hr></td></tr>";
                                }
                                
                                $prev_order_date = $r['order_date'];
                                $order_total = 0;
                                $delivery_charges = $r['delivery_charges'];
                            }
                            
                            $order_total += $r['total'];
                        ?>
                            <tr>
                                <td><?php echo $r['pname']; ?></td>
                                <td>₹<?php echo $r['price']; ?></td>
                                <td><?php echo $r['qty']; ?></td>
                                <td>₹<?php echo $r['total']; ?></td>
                                <?php if ($show_order_info) { ?>
                                    <td><?php echo date('d-m-Y H:i', strtotime($r['order_date'])); ?></td>
                                    <td><span class="badge bg-success p-2"><?php echo $r['status']; ?></span></td>
                                    <td>
                                        <?php if($r['paid'] == 1) { ?>
                                            <span class="badge bg-success">Paid</span>
                                        <?php } else { ?>
                                            <span class="badge bg-warning">Pending</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($r['status'] == 'Cancelled') { ?>
                                            <span class="badge bg-danger">Order Canceled</span>
                                        <?php } elseif ($r['cancel_request'] == 't') { ?>
                                            <span class="badge bg-warning">Cancellation in Process</span>
                                        <?php } elseif ($r['status'] == 'Out For Delivery' || $r['status'] == 'Delivered') { ?>
                                            <span class="text-muted">Cancellation Not Allowed</span>
                                        <?php } else { ?>
                                            <form method="post">
                                                <input type="hidden" name="order_date" value="<?php echo $r['order_date']; ?>">
                                                <button type="submit" name="btnCancelRequest" class="btn btn-danger btn-sm">Cancel Order</button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                <?php } else { ?>
                                    <td colspan="4"></td>
                                <?php } ?>
                            </tr>
                        <?php }
                        if ($prev_order_date !== null) {
                            echo "<tr>
                                    <td colspan='3' class='text-end fw-bold'>Subtotal</td>
                                    <td class='fw-bold'>₹$order_total</td>
                                    <td colspan='4'></td>
                                </tr>
                                <tr>
                                    <td colspan='3' class='text-end fw-bold'>Delivery Charges</td>
                                    <td class='fw-bold'>₹$delivery_charges</td>
                                    <td colspan='4'></td>
                                </tr>
                                <tr class='table-secondary'>
                                    <td colspan='3' class='text-end fw-bold'>Grand Total</td>
                                    <td class='fw-bold'>₹" . ($order_total + $delivery_charges) . "</td>
                                    <td colspan='4'></td>
                                </tr>
                                <tr><td colspan='8'><hr></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'footer.php';?>
</body>
</html>
