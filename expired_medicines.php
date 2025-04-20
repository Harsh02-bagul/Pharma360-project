<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expired Medicines</title>
    <?php include 'head.php'; ?> 
</head>
<body>

<?php include 'menu.php'; ?> 

<div class="container mt-5">
    <h2 class="text-danger">Expired Medicines</h2>
    
    <table class="table table-bordered">
        <tr>
            <th>Medicine Name</th>
            <th>Original Price</th>
            <th>Discounted Price</th>
            <th>Stock</th>
            <th>Expiry Date</th>
            <th>Action</th>
        </tr>

        <?php
        $today = date('Y-m-d'); 
        $q = pg_query("SELECT * FROM tblproduct WHERE pdate < '$today'"); 

        while ($r = pg_fetch_array($q)) {
        ?>
            <tr>
                <td><?php echo $r['pname']; ?></td>
                <td><?php echo $r['pprice']; ?></td>
                <td><?php echo $r['pdprice']; ?></td>
                <td><?php echo $r['pstock']; ?></td>
                <td class="text-danger"><?php echo $r['pdate']; ?></td>
                <td>
                    <a href="delete_expired.php?id=<?php echo $r['pid']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this expired medicine?');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>

<?php include 'footer.php'; ?> 
</body>
</html>
