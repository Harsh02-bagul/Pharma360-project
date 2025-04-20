<?php
session_start(); 

if (!isset($_SESSION['uid'])) {
    echo "<script>alert('Please log in first.'); window.location.href='login.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Billing</title>
  <?php include 'head.php'; ?>
</head>
<body>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>


<div class="container mt-4">
    <h2 class="text-center mb-4 fw-bold text-primary">Billing Details</h2>

    <table class="table table-bordered table-hover table-striped table-light">

        <tr><td>Name:</td><td><?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?></td></tr>
        <tr><td>Email:</td><td><?php echo $_SESSION['email']; ?></td></tr>
        <tr><td>Phone:</td><td><?php echo $_SESSION['uphone']; ?></td></tr>
        <tr><td>Address:</td><td>
            <?php
            $q1 = pg_query("SELECT * FROM tbladdress WHERE aid=".$_GET['id']." AND uid=".$_SESSION['uid']);
            if ($r1 = pg_fetch_array($q1)) {
                echo $r1['aname'];
            } else {
                echo "<script>alert('Invalid Address Selection!'); window.location.href='address.php';</script>";
                exit();
            }
            ?>
        </td></tr>
    </table>

    
    <h3 class="mb-3 text-center bg-primary text-white p-2 rounded">Order Summary</h3>

    <table class="table table-bordered table-hover table-striped table-light">

        <tr>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>

        <?php
        $total = 0;
        $q = pg_query("SELECT * FROM tblproduct INNER JOIN tblcart ON tblproduct.pid = tblcart.pid WHERE tblcart.uid = ".$_SESSION['uid']." ");
        while ($r = pg_fetch_array($q)) {
        ?>
            <tr>
                <td><?php echo $r['pname']; ?></td>
                <td><?php echo $r['pdprice']; ?></td>
                <td><?php echo $r['qty']; ?></td>
                <td>
                    <?php 
                    $subtotal = $r['pdprice'] * $r['qty'];
                    $total += $subtotal;
                    echo $subtotal;
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>

    
        <?php
        $delivery_charge = 0;
        preg_match('/\b42[0-9]{4}\b/', $r1['aname'], $matches);
        $pincode = isset($matches[0]) ? $matches[0] : null;

        if ($pincode >= 422001 && $pincode <= 422013) {
            if ($pincode == 422001 || $pincode == 422002) {
                $delivery_charge = 0; 
            } elseif ($pincode == 422003 || $pincode == 422006 || $pincode == 422011) {
                $delivery_charge = 30;
            } elseif ($pincode == 422004 || $pincode == 422007 || $pincode == 422008 || $pincode == 422012) {
                $delivery_charge = 40;
            } else {
                $delivery_charge = 50; 
            }
        }
        $grand_total = $total + $delivery_charge;
        ?>

        <tr><td>Subtotal</td><td><?php echo $total; ?></td></tr>
        <tr><td>Delivery Charges</td><td><?php echo $delivery_charge; ?></td></tr>
        <tr><td><b>Grand Total</b></td><td><b><?php echo $grand_total; ?></b></td></tr>
    </table>

    
    <form method="post">
        <h3 class="text-center bg-success text-white p-2 rounded">Select Payment Method</h3>

        <label>
            <input type="radio" name="payment_method" value="online" required onclick="showGPay(true)"> Online Payment (Google Pay)
        </label>
        <br>
        <label>
            <input type="radio" name="payment_method" value="offline" required onclick="showGPay(false)"> Cash on Delivery
        </label>
        
        <div id="gpay_image"  style="display:none; margin-top: 15px;">
            <img src="gpay.jpg" height="200px" width="200px">
        </div>

        <br><br>
        <input type="submit" name="btnpay" value="Place Order" class="btn btn-primary">
    </form>
</div>

<?php
if (isset($_POST['btnpay'])) {
    if (!isset($_POST['payment_method'])) {
        echo "<script>alert('Please select a payment method.');</script>";
    } else {
        $aid = $_GET['id']; // Address ID
        $uid = $_SESSION['uid']; // User ID
        $payment_method = $_POST['payment_method']; // Online/Offline Payment

        
            
            $paid_status = 0;
            $order_time = date('Y-m-d H:i:s');
            
            
            $cart_items = pg_query("SELECT c.*, p.pname, p.pdprice FROM tblcart c 
                                  INNER JOIN tblproduct p ON c.pid = p.pid 
                                  WHERE c.uid=$uid ");
            
            $success = true;
            while ($item = pg_fetch_array($cart_items)) {
                $pid = $item['pid'];
                $qty = $item['qty'];
                $price = $item['pdprice'];
                $total = $price * $qty;
                
                 $insert_order = pg_query("INSERT INTO tblorders (uid, pid, qty, price, total, aid, payment_method, order_date, status, paid, delivery_charges) 
                            VALUES ($uid, $pid, $qty, $price, $total, '$aid', '$payment_method', '$order_time', 'Order Placed', 0, $delivery_charge)");
                                        
                                        
                if (!$insert_order) {
                    $success = false;
                      echo "<script>alert('Database Error: " . addslashes($error) . "');</script>";
                    break;
                }
            }
            
            if ($success) {
                
                $delete_cart = pg_query("DELETE FROM tblcart WHERE uid=$uid ");
                
                if ($delete_cart) {
                    echo "<script>alert('Thank you for shopping with Pharma360! Your order has been placed successfully. Note: Order cancellation is only allowed before the product is out for delivery.'); window.location.href='orders.php';</script>";
                } else {
                    echo "<script>alert('Order placed but cart cleanup failed. Please contact support.');</script>";
                }
            } else {
                echo "<script>alert('Failed to place order. Please try again.');</script>";
            }
        
    }
}
?>

<script>
function showGPay(show) {
    document.getElementById('gpay_image').style.display = show ? 'block' : 'none';
}
</script>

<?php include 'footer.php'; ?>
</body>
</html>
