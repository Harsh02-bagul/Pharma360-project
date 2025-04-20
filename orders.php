<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Management</title>
    <?php include 'head.php'; ?>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container-fluid mt-4">
    <div class="card shadow-sm p-4">
        <h2 class="text-center mb-4 text-primary">Order Management</h2>

        <div class="table-responsive">
            <table class="table table-bordered  table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>

                        <th>Gender</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Payment Method</th>
                        <th>Order Time</th>
                        <th>Cancellation Request</th> 
                        <th>Status</th>
                        <th>Payment Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $prev_order_date = null;
                    $order_total = 0;

                    $q = pg_query("SELECT o.order_date, u.firstname, u.lastname, u.email, u.phone, u.gender, a.aname, 
                                          p.pname, o.price, o.qty, (o.price * o.qty) AS total, 
                                          o.payment_method, o.status, o.paid, o.cancel_request, o.delivery_charges 
                                   FROM tblorders o
                                   INNER JOIN tblproduct p ON p.pid = o.pid
                                   INNER JOIN tbluser u ON u.uid = o.uid
                                   INNER JOIN tbladdress a ON a.aid = o.aid
                                   ORDER BY o.order_date DESC");

                    while ($r = pg_fetch_array($q)) {
                        $show_order_info = ($prev_order_date !== $r['order_date']);
                        if ($show_order_info) {
                            if ($prev_order_date !== null) {
                                echo "<tr >
                                        <td colspan='6' class='text-end fw-bold'>Subtotal</td>
                                        <td class='fw-bold'>₹$order_total</td>
                                        <td colspan='8'></td>
                                      </tr>
                                      <tr>
                                        <td colspan='6' class='text-end fw-bold'>Delivery Charges</td>
                                        <td class='fw-bold'>₹$delivery_charges</td>
                                        <td colspan='8'></td>
                                      </tr>
                                      <tr class='table-secondary'>
                                        <td colspan='6' class='text-end fw-bold'>Grand Total</td>
                                        <td class='fw-bold text-primary'>₹" . ($order_total + $delivery_charges) . "</td>
                                        <td colspan='8'></td>
                                      </tr>
                                      <tr><td colspan='15'><hr></td></tr>";
                            }
                            $prev_order_date = $r['order_date'];
                            $order_total = 0;
                            $delivery_charges = $r['delivery_charges'];
                        }
                        $order_total += $r['total'];
                    ?>
                        <tr>
                            <?php if ($show_order_info) { ?>
                                <td><?php echo $r['firstname'] . " " . $r['lastname']; ?></td>
                                <td><?php echo $r['email']; ?></td>
                                <td><?php echo $r['phone']; ?></td>
                                <td><?php echo $r['aname']; ?></td>
                                <td><?php echo $r['gender']; ?></td>
                            <?php } else { ?>
                                <td colspan="5"></td>
                            <?php } ?>
                            <td><?php echo $r['pname']; ?></td>
                            <td>₹<?php echo $r['price']; ?></td>
                            <td><?php echo $r['qty']; ?></td>
                            <td>₹<?php echo $r['total']; ?></td>
                            <?php if ($show_order_info) { ?>
                                <td><?php echo ucfirst($r['payment_method']); ?></td>
                                <td><?php echo date('Y-m-d H:i', strtotime($r['order_date'])); ?></td>
                                <td>
                                    <?php if ($r['status'] == 'Cancelled') { ?>
                                        <span class="badge bg-success p-2">No Request</span>
                                    <?php } elseif ($r['cancel_request'] == 't') { ?>
                                        <span class="badge bg-warning p-2">Requested</span>
                                    <?php } else { ?>
                                        <span class="badge bg-success p-2">No Request</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <span class="badge <?php echo ($r['status'] == 'Cancelled') ? 'bg-danger' : 'bg-success'; ?> p-2">
                                        <?php echo $r['status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge <?php echo ($r['paid'] == 1) ? 'bg-success' : 'bg-warning'; ?> p-2">
                                        <?php echo ($r['paid'] == 1) ? 'Paid' : 'Pending'; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="changestatus.php?order_date=<?php echo $r['order_date']; ?>" class="btn btn-primary btn-sm">
                                        Update Status
                                    </a>
                                </td>
                            <?php } else { ?>
                                <td colspan="5"></td>
                            <?php } ?>
                        </tr>
                    <?php }
                    if ($prev_order_date !== null) {
                        echo "<tr >
                                <td colspan='6' class='text-end fw-bold'>Subtotal</td>
                                <td class='fw-bold'>₹$order_total</td>
                                <td colspan='8'></td>
                              </tr>
                              <tr>
                                <td colspan='6' class='text-end fw-bold'>Delivery Charges</td>
                                <td class='fw-bold'>₹$delivery_charges</td>
                                <td colspan='8'></td>
                              </tr>
                              <tr class='table-secondary'>
                                <td colspan='6' class='text-end fw-bold'>Grand Total</td>
                                <td class='fw-bold text-primary'>₹" . ($order_total + $delivery_charges) . "</td>
                                <td colspan='8'></td>
                              </tr>
                              <tr><td colspan='15'><hr></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
