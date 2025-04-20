<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Supplier</title>
  <?php include 'head.php'; ?>
</head>
<body>
<?php include 'menu.php'; ?>

<?php
if(isset($_POST['btnaddsup'])){
  $sname = pg_escape_string($conn, $_POST['txtsname']);
  $scontact = pg_escape_string($conn, $_POST['txtscontact']);
  $semail = pg_escape_string($conn, $_POST['txtsemail']);
  $saddress = pg_escape_string($conn, $_POST['txtsaddress']);

  $query = "INSERT INTO tblsupplier (sname, scontact, semail, saddress) 
            VALUES ('$sname', '$scontact', '$semail', '$saddress')";

  $result = pg_query($conn, $query);

  if ($result) {
    echo "<script>alert('Supplier Added Successfully!'); window.location.href='manage_suppliers.php';</script>";
  } else {
    echo "<script>alert('Error adding Supplier.');</script>";
  }
}
?>

<div class="row">
  <div class="col-md-8">
    <form method="post">
      <table class="table">
        <tr>
          <td>Name</td>
          <td><input type="text" class="form-control" name="txtsname" required></td>
        </tr>
        <tr>
          <td>Contact</td>
          <td><input type="text" class="form-control" name="txtscontact" required></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input type="email" class="form-control" name="txtsemail" required></td>
        </tr>
        <tr>
          <td>Address</td>
          <td><textarea name="txtsaddress" class="form-control" required></textarea></td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="submit" name="btnaddsup" value="Add Supplier" class="btn btn-success">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
