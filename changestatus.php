<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Update Order Status</title>
  <?php include 'head.php'; ?>
</head>
<body>

<?php include 'menu.php'; ?>

<form method="post">
  <table class="table">
    
    <tr>
      <td>Choose Order Status</td>
      <td>
        <select class="form-control" name="cmbstatus">
          <option value="Shipping">Shipping</option>
          <option value="Out For Delivery">Out For Delivery</option>
          <option value="Delivered">Delivered</option>
          <option value="Cancelled">Order Canceled</option>
        </select>
      </td>
    </tr>

    <tr>
      <td>Payment Status</td>
      <td>
        <select class="form-control" name="cmbpayment">
          <option value="0">Not Paid</option>
          <option value="1">Paid</option>
        </select>
      </td>
    </tr>

    <tr>
      <td colspan="2">
        <input type="submit" name="btnupdate" value="Update Order" class="btn btn-success">
      </td>
    </tr>
  </table>
</form>

<?php
if (isset($_POST['btnupdate'])) {
    extract($_POST);

    
    if (!isset($_GET['order_date'])) {
        echo "<script>alert('Invalid order date.'); window.location.href='orders.php';</script>";
        exit();
    }
    $order_date = $_GET['order_date'];


    pg_query("UPDATE tblorders SET status='$cmbstatus', paid='$cmbpayment' WHERE order_date='$order_date'");

    if ($cmbstatus == 'Cancelled') {
        pg_query("UPDATE tblorders SET cancel_request=FALSE, status='$cmbstatus' WHERE order_date='$order_date'");
    }

    echo "<script>alert('Order status updated successfully!'); window.location.href='orders.php';</script>";
}
?>

<?php include 'footer.php'; ?>
</body>
</html>
