<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include 'head.php'; ?> 
</head>
<body>

<?php include 'menu.php'; ?> 

<?php

$expiredQuery = pg_query("SELECT COUNT(*) AS expired_count FROM tblproduct WHERE pdate < CURRENT_DATE");
$expiredData = pg_fetch_assoc($expiredQuery);
$expiredCount = $expiredData['expired_count'];

$outOfStockQuery = pg_query("SELECT COUNT(*) AS out_of_stock_count FROM tblproduct WHERE pstock < 10");
$outOfStockData = pg_fetch_assoc($outOfStockQuery);
$outOfStockCount = $outOfStockData['out_of_stock_count'];
?>

<div class="container mt-5 text-center">
    <h1 class="display-4">Welcome, HARSH!</h1>
    <h3 class="text-primary">Hello, Administrator 👋</h3>

    <p class="lead mt-3">
        This is your <b>Admin Dashboard</b> where you can <b>manage employees, suppliers, orders, and more.</b>
    </p>

    <?php if ($expiredCount > 0) { ?>
        <div class="alert alert-danger" role="alert">
            <strong>Warning:</strong> There are <b><?php echo $expiredCount; ?></b> expired medicines!
            <a href="expired_medicines.php" class="btn btn-sm btn-danger">View Expired Medicines</a>
        </div>
    <?php } ?>

    <?php if ($outOfStockCount > 0) { ?>
        <div class="alert alert-warning" role="alert">
            <strong>Warning:</strong> There are <b><?php echo $outOfStockCount; ?></b> products that are out of stock!
            <a href="out_of_stock_products.php" class="btn btn-sm btn-warning">View Out of Stock Products</a>
        </div>
    <?php } ?>

</div>

<?php include 'footer.php'; ?> 
</body>
</html>
