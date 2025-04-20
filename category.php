<?php
include 'head.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manage Categories</title>
</head>
<body>
<?php include 'menu.php'; ?>

<a href="addcategory.php"><input type="button" class="btn btn-warning" value="Add Category"></a>

<!-- Display Categories -->
<div class="row">
    <div class="col-md-12">
        <h2>Category List</h2>
        <table class="table">
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>

            <?php
            $q = pg_query($conn, "SELECT * FROM tblcategory ORDER BY cid");

            if (!$q) {
                echo "<tr><td colspan='3'>Error fetching categories: " . pg_last_error($conn) . "</td></tr>";
            } else {
                $num_rows = pg_num_rows($q);
                if ($num_rows == 0) {
                    echo "<tr><td colspan='3'>No categories found.</td></tr>";
                } else {
                    while ($r = pg_fetch_assoc($q)) {
                        echo "<tr>
                                <td>{$r['cid']}</td>
                                <td>{$r['cname']}</td>
                                <td>
                                    <a href='deletecat.php?id={$r['cid']}' onclick='return confirm(\"Are you sure you want to delete this category?\")'>
                                        <input type='button' value='Delete' class='btn btn-danger'>
                                    </a>
                                </td>
                              </tr>";
                    }
                }
            }
            ?>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
