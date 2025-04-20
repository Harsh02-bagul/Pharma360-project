<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Category</title>
</head>
<body>
<?php include 'menu.php'; ?>

<?php
include 'head.php';

if (isset($_POST['add'])) {
    $cname = $_POST['cname'];

    
    $query = pg_query($conn, "INSERT INTO tblcategory (cname) VALUES ('$cname')");

    if ($query) {
        echo "<script>alert('Category added successfully!'); window.location.href='category.php';</script>";
    } else {
        echo "<script>alert('Error adding category: " . pg_last_error($conn) . "');</script>";
    }
}
?>


<div class="container">
    <h2>Add Category</h2>
    <form method="post">
        <label>Category Name:</label>
        <input type="text" name="cname" required class="form-control">
        <br>
        <input type="submit" name="add" value="Add Category" class="btn btn-success">
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
