<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Employee</title>
  <?php include 'head.php'; ?>
</head>
<body>
<?php include 'menu.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ename = $_POST['ename'];
    $eemail = $_POST['eemail'];
    $epass = $_POST['epass'];
    $ephone = $_POST['ephone'];
    $erole = $_POST['erole'];
    $eaddress = $_POST['eaddress'];
    $esalary = $_POST['esalary'];

    
    $ename = pg_escape_string($conn, $ename);
    $eemail = pg_escape_string($conn, $eemail);
    $epass = pg_escape_string($conn, $epass);
    $ephone = pg_escape_string($conn, $ephone);
    $erole = pg_escape_string($conn, $erole);
    $eaddress = pg_escape_string($conn, $eaddress);
    $esalary = (float)$esalary;

    
    $query = "INSERT INTO tblemployee (ename, eemail, epass, ephone, erole, eaddress, esalary) 
              VALUES ('$ename', '$eemail', '$epass', '$ephone', '$erole', '$eaddress', '$esalary')";
    $result = pg_query($conn, $query);
    
    if ($result) {
        echo "<script>alert('Employee added successfully!'); window.location.href='manage_employees.php';</script>";
    } else {
        echo "<script>alert('Error adding employee.');</script>";
    }
}
?>

<div class="container">
  <h2>Add Employee</h2>
  <form method="POST">
    <label>Name:</label>
    <input type="text" name="ename" class="form-control" required>

    <label>Email:</label>
    <input type="email" name="eemail" class="form-control" required>

    <label>Password:</label>
    <input type="password" name="epass" class="form-control" required>

    <label>Phone:</label>
    <input type="text" name="ephone" class="form-control" required>

    <label>Role:</label>
    <select name="erole" class="form-control" required>
      <option value="Stock Manager">Stock Manager</option>
      <option value="Delivery Boy">Delivery Boy</option>
    </select>

    <label>Address:</label>
    <textarea name="eaddress" class="form-control" required></textarea>

    <label>Salary (₹):</label>
    <input type="number" name="esalary" class="form-control" step="0.01" required>

    <br>
    <input type="submit" value="Add Employee" class="btn btn-success">
  </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
