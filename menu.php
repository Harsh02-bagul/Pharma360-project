<header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container pt-3">
          <a class="navbar-brand" href="about.php">
            <img src="images/logo1.jpg" alt="logo">
            <span>
              PHARMA360
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex  flex-column flex-lg-row align-items-center w-100 justify-content-between">
              <ul class="navbar-nav  ">
               
             
        
        <?php
        if($_SESSION['email']==null){
          ?>
         <li class="nav-item active">
                  <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
        
         <li  class="nav-item">  <a class="nav-link" href="register.php">Register</a></li>
        
        
       <li class="nav-item">    <a class="nav-link" href="login.php">Login</a></li>
        
        <?php
      }else{
      ?>
      
         <li class="nav-item">  <a class="nav-link" href="welcome.php">Products</a></li>

        <li class="nav-item">  <a class="nav-link" href="viewdoctors.php">Consulatancy</a></li>
        
         <li class="nav-item">  <a class="nav-link" href="viewcart.php">View Cart</a></li>
        
        
        <li class="nav-item">   <a class="nav-link" href="orders.php">My Orders</a></li>
       <li class="nav-item">   <a class="nav-link" href="feedback.php">Feedback</a></li>
           
    
      <?php
    }
    ?>
              </ul>
            <?php if ($_SESSION['email'] != null) { ?>
  <div class="ms-auto">
    <a class="nav-link d-flex align-items-center text-white" href="profile.php" style="color: inherit ;">
      <i class="bi bi-person-circle fs-4"></i>
      <span class="ms-2 d-none d-lg-inline">My Profile</span>
    </a>
  </div>
<?php } ?>
              
            </div>
          </div>

        </nav>
      </div>
    </header>

              