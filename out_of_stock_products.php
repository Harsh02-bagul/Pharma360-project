<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Low Stock Products</title>
    <?php include 'head.php'; ?>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container mt-5">
    <h2 class="text-danger text-center">Low Stock Products (Stock &lt; 10)</h2>

    <?php
    

    
    $query = pg_query("SELECT * FROM tblproduct WHERE pstock < 10");

    if (pg_num_rows($query) > 0) {
    ?>

    <table class="table table-bordered text-center mt-4">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Update Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = pg_fetch_assoc($query)) { ?>
                <tr>
                    <td><?php echo $row['pid']; ?></td>
                    <td><?php echo $row['pname']; ?></td>
                    <td>
                        <?php 
                        $catQuery = pg_query("SELECT cname FROM tblcategory WHERE cid = ".$row['cid']);
                        $catRow = pg_fetch_assoc($catQuery);
                        echo $catRow['cname']; 
                        ?>
                    </td>
                    <td>₹<?php echo $row['pprice']; ?></td>
                    <td>
                        <span class="badge bg-warning">
                            <?php echo $row['pstock']; ?> left
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="product_id" value="<?php echo $row['pid']; ?>">
                            <input type="number" name="new_stock" min="1" required>
                            <button type="submit" name="update_stock" class="btn btn-success btn-sm">Update</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php
    } else {
        echo "<p class='text-center text-success'>All products have sufficient stock!</p>";
    }
    ?>
</div>



<?php
if (isset($_POST['update_stock'])) {
    

    $product_id = $_POST['product_id'];
    $new_stock = $_POST['new_stock'];

    // Update stock in database
    $updateQuery = pg_query("UPDATE tblproduct SET pstock = $new_stock WHERE pid = $product_id");

    if ($updateQuery) {
        echo "<script>alert('Stock updated successfully!'); window.location.href='out_of_stock_products.php';</script>";
    } else {
        echo "<script>alert('Failed to update stock. Try again!');</script>";
    }
}
?>
<?php include 'footer.php'; ?>
</body>
</html>
