<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Manage Suppliers</title>
  <?php include 'head.php'; ?>
</head>
<body>
<?php include 'menu.php'; ?>
<a href="addsupplier.php"><input type="button" class="btn btn-warning" value="Add Supplier"></a>
<div class="row">
  <div class="col-md-12">
    <table class="table">
      <tr>
        <th>Supplier ID</th>
        <th>Name</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Address</th>
        <th>Action</th>
      </tr>
      <?php
        
        $q = pg_query($conn, "SELECT * FROM tblsupplier");
        while ($r = pg_fetch_array($q)) {
      ?>
        <tr>
          <td><?php echo $r['sid']; ?></td>
          <td><?php echo $r['sname']; ?></td>
          <td><?php echo $r['scontact']; ?></td>
          <td><?php echo $r['semail']; ?></td>
          <td><?php echo $r['saddress']; ?></td>
          <td>
            <a href="deletesupplier.php?id=<?php echo $r['sid']; ?>"><input type="button" value="Delete" class="btn btn-danger"></a>
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
