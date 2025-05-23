<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback List</title>
    <?php include 'head.php'; ?>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Feedback List</h2>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q = pg_query("SELECT tbluser.firstname, tbluser.lastname, tbluser.phone, tblfeedback.fname 
                                   FROM tblfeedback 
                                   INNER JOIN tbluser ON tbluser.uid = tblfeedback.uid");

                    while ($r = pg_fetch_array($q)) {
                    ?>
                        <tr>
                            <td><?php echo $r['firstname'] . " " . $r['lastname']; ?></td>
                            <td><?php echo $r['phone']; ?></td>
                            <td><?php echo $r['fname']; ?></td>
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
