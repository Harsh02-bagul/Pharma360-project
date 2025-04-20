<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Doctor</title>
  <?php include 'head.php'; ?>
</head>
<body>
<?php include 'menu.php'; ?>

<?php
if(isset($_POST['btnadddoc'])){
  $dname = pg_escape_string($conn, $_POST['txtdname']);
  $dspecialization = pg_escape_string($conn, $_POST['txtdspecialization']);
  $dcontact = pg_escape_string($conn, $_POST['txtdcontact']);
  $demail = pg_escape_string($conn, $_POST['txtdemail']);
  $dhospital = pg_escape_string($conn, $_POST['txtdhospital']);

  $query = "INSERT INTO tbldoctor (dname, dspecialization, dcontact, demail, dhospital) 
            VALUES ('$dname', '$dspecialization', '$dcontact', '$demail', '$dhospital')";

  $result = pg_query($conn, $query);

  if ($result) {
    echo "<script>alert('Doctor Added Successfully!'); window.location.href='manage_doctors.php';</script>";
  } else {
    echo "<script>alert('Error adding doctor.');</script>";
  }
}
?>

<div class="row">
  <div class="col-md-8">
    <form method="post">
      <table class="table">
        <tr>
          <td>Name</td>
          <td><input type="text" class="form-control" name="txtdname" required></td>
        </tr>
        <tr>
          <td>Specialization</td>
          <td><input type="text" class="form-control" name="txtdspecialization" required></td>
        </tr>
        <tr>
          <td>Contact</td>
          <td><input type="text" class="form-control" name="txtdcontact" required></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input type="email" class="form-control" name="txtdemail" required></td>
        </tr>
        <tr>
          <td>Hospital Address</td>
          <td><textarea name="txtdhospital" class="form-control" required></textarea></td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="submit" name="btnadddoc" value="Add Doctor" class="btn btn-success">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
