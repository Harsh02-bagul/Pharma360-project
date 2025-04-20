<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products Report</title>
    <?php include 'head.php'; ?>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Products Reports</h2>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Product ID</th>
                        <th>Category Name</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q = pg_query("SELECT * FROM tblcategory, tblproduct WHERE tblcategory.cid = tblproduct.cid");
                    while ($r = pg_fetch_array($q)) {
                    ?>
                        <tr>
                            <td><?php echo $r['pid']; ?></td>
                            <td><?php echo $r['cname']; ?></td>
                            <td><?php echo $r['pname']; ?></td>
                            <td><?php echo $r['pdprice']; ?></td>
                        </tr>
                    <?php
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
