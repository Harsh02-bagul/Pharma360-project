<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customers Report</title>
    <?php include 'head.php'; ?>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Customers Report</h2>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q = pg_query("SELECT * FROM tbluser");
                    while ($r = pg_fetch_array($q)) {
                    ?>
                        <tr>
                            <td><?php echo $r['firstname'] . " " . $r['lastname']; ?></td>
                            <td><?php echo $r['email']; ?></td>
                            <td><?php echo $r['phone']; ?></td>
                            <td><?php echo $r['gender']; ?></td>
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
