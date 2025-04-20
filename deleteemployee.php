<?php
 include 'head.php';
pg_query($conn, "DELETE FROM tblemployee WHERE eid=".$_GET['id']);
?>
<script type="text/javascript">
  window.location.href="manage_employees.php";
</script>
