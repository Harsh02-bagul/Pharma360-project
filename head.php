<?php
$conn=pg_connect("host=localhost user=postgres password=postgres dbname=pharma360");
 if (!$conn) {
    die("❌ Database Connection Failed: " . pg_last_error());
}
  ?>
<link rel="stylesheet" href="dist/css/adminlte.css" />
<link rel="stylesheet" type="text/css" href="css/custom.css">
