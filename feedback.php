<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Feedback</title>
  <?php include 'head.php';?>
</head>
<body>
  <?php include 'header.php';?>
  <?php include 'menu.php';?>

  <?php
  if(isset($_POST['btnaddfeed'])){
    extract($_POST);
    pg_query("INSERT INTO tblfeedback(fname,uid) VALUES ('$txtfeedback','".$_SESSION['uid']."')");
    ?>
    <script type="text/javascript">
      alert("Thank you for your feedback!");
      window.location.href = 'welcome.php';
    </script>
    <?php
  }
  ?>

  <div class="container mt-5">
    <div class="card shadow-lg border-0 p-4">
      <h2 class="text-center text-primary mb-3">We Value Your Feedback</h2>
      <p class="text-center lead">Help us improve by sharing your thoughts and experiences.</p>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <form method="post">
            <div class="mb-3">
              <label for="txtfeedback" class="form-label fw-bold">Your Feedback</label>
              <textarea name="txtfeedback" class="form-control" rows="4" required></textarea>
            </div>
            <div class="text-center">
              <button type="submit" name="btnaddfeed" class="btn btn-success btn-lg">Submit Feedback</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php';?>
</body>
</html>
