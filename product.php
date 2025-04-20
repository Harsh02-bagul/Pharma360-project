<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <?php include 'head.php';?>
</head>
<body>
<?php include 'menu.php';?>
<a href="addproduct.php"><input type="button" class="btn btn-warning" value="Add Product"></a>
<div class="row">
  <div class="col-md-12">
    <table class="table">
      <tr>
         <th>
          Product Id
        </th>
        <th>
         Category Name
        </th>
        <th>
          Product Name
        </th>
           <th>
          Product Price
        </th>
    </tr>
    <?php
      $q=pg_query("select * from tblcategory,tblproduct where tblcategory.cid=tblproduct.cid");
      while ($r=pg_fetch_array($q)) {
       
        ?>
        <tr>
          <td><?php echo $r['pid'];?></td>
           <td><?php echo $r['cname'];?></td>
           <td><?php echo $r['pname'];?></td>
           <td><?php echo $r['pdprice'];?></td>
           <Td><a href="deleteprod.php?id=<?php echo $r['pid'];?>"><input type="button" value="Delete" class="btn btn-danger"></a></Td>
        </tr>
        <?php
      }

    ?>
    </table>
  </div>
</div>
<?php include 'footer.php';?>
</body>
</html>



   