<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Manage Employees</title>
  <?php include 'head.php'; ?>
</head>
<body>
<?php include 'menu.php'; ?>
<a href="addemployee.php"><input type="button" class="btn btn-warning" value="Add Employee"></a>
<div class="row">
  <div class="col-md-12">
    <table class="table">
      <tr>
        <th>Employee ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Role</th>
        <th>Address</th>
        <th>Salary</th>
        <th>Action</th>
      </tr>
      <?php
        include 'head.php'; 
        $q = pg_query($conn, "SELECT * FROM tblemployee");
        while ($r = pg_fetch_array($q)) {
      ?>
        <tr>
          <td><?php echo $r['eid']; ?></td>
          <td><?php echo $r['ename']; ?></td>
          <td><?php echo $r['eemail']; ?></td>
          <td><?php echo $r['ephone']; ?></td>
          <td><?php echo $r['erole']; ?></td>
          <td><?php echo $r['eaddress']; ?></td>
          <td>₹<?php echo number_format($r['esalary'], 2); ?></td>
          <td>
            <a href="deleteemployee.php?id=<?php echo $r['eid']; ?>">
              <input type="button" value="Delete" class="btn btn-danger">
            </a>
          </td>
        </tr>
      <?php
        }
      ?>
    </table>
  </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
