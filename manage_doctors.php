<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Manage Doctors</title>
  <?php include 'head.php'; ?>
</head>
<body>
<?php include 'menu.php'; ?>
<a href="adddoctor.php"><input type="button" class="btn btn-warning" value="Add Doctor"></a>
<div class="row">
  <div class="col-md-12">
    <table class="table">
      <tr>
        <th>Doctor ID</th>
        <th>Name</th>
        <th>Specialization</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Hospital Address</th>
        <th>Action</th>
      </tr>
      <?php
        include '../db_connect.php';
        $q = pg_query($conn, "SELECT * FROM tbldoctor");
        while ($r = pg_fetch_array($q)) {
      ?>
        <tr>
          <td><?php echo $r['did']; ?></td>
          <td><?php echo $r['dname']; ?></td>
          <td><?php echo $r['dspecialization']; ?></td>
          <td><?php echo $r['dcontact']; ?></td>
          <td><?php echo $r['demail']; ?></td>
          <td><?php echo $r['dhospital']; ?></td>
          <td>
            <a href="deletedoctor.php?id=<?php echo $r['did']; ?>" onclick="return confirm('Are you sure you want to delete this doctor?');">
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
