<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <?php include 'head.php';?>
</head>
<body>
<?php include 'menu.php';?>
<?php
if(isset($_POST['btnaddprod'])){
  extract($_POST);
  $target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

 
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "<script>alert('The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded successfully.');</script>";
} else {
    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
}


 $result=pg_query("INSERT INTO tblproduct(pname, pprice, pdprice, pdesc, pimage, pvideo, pstock, cid, pdate) VALUES ('$txtpname','$txtpprice','$txtpdprice','$txtdesc','$target_file','$txtvideo','$txtstock','$cmbcategory','$txtdate')");

     if ($result) {
        echo "<script>alert('Product added successfully!'); window.location.href='product.php';</script>";
    } else {
        echo "<script>alert('Error inserting product: " . pg_last_error() . "');</script>";
    }
}
?>
<div class="row">
  <div class="col-md-8">

<form method="post" enctype="multipart/form-data">
  <table class="table">
    <tr>
      <Td>
        Choose Category
      </Td>
      <td>
        <select class="form-control" name="cmbcategory">
          <option>--Select--</option>
         <?php
          $q=pg_query("select * from tblcategory");
          while ($r=pg_fetch_array($q)) {
           echo "<option value=".$r['cid'].">".$r['cname']."</option>";
          }
          ?>
        </select>
      </td>
    </tr>
    <Tr>
      <TD>
        Product Name
      </TD>
      <td>
        <input type="text" class="form-control" name="txtpname">
      </td>
    </Tr>
     <Tr>
      <TD>
        Product Price
      </TD>
      <td>
        <input type="text" class="form-control" name="txtpprice">
      </td>
    </Tr>
    <Tr>
      <TD>
        Product Discount Price
      </TD>
      <td>
        <input type="text" class="form-control" name="txtpdprice">
      </td>
    </Tr>
    
    <Tr>
      <TD>
        Product Image
      </TD>
      <td>
  <input type="file" name="fileToUpload" id="fileToUpload">
      </td>
    </Tr>
    <Tr>
      <TD>
        Product Video
      </TD>
      <td>
        <input type="text" class="form-control" name="txtvideo">
      </td>
    </Tr>
    <Tr>
      <TD>
        Product Stock
      </TD>
      <td>
        <input type="text" class="form-control" name="txtstock">
      </td>
    </Tr>
    <Tr>
      <TD>
        Product Expiry Date
      </TD>
      <td>
        <input type="date" class="form-control" name="txtdate">
      </td>
    </Tr>
    <Tr>
      <TD>
        Product Description
      </TD>
      <td>
        <textarea name="txtdesc" class="form-control"></textarea>
      </td>
    </Tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btnaddprod" value="Add Product" class="btn btn-success">
      </td>
    </tr>
  </table>
</form>
</div>
</div>
<?php include 'footer.php';?>
</body>
</html>



   