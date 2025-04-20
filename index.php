<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pharma360 - Home</title>
    <?php include 'head.php'; ?>

</head>

<body class="bg-light d-flex flex-column min-vh-100">


<header class=" w-100 bg-white shadow">
    <?php include 'header.php'; ?>
    <?php include 'menu.php'; ?>
</header>


<main class="flex-grow-1 mt-5">
    <section class="slider_section position-relative">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            
        
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" style="background-color: #555;"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" style="background-color: #555;"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" style="background-color: #555;"></li>
            </ol>

        
            <div class="carousel-inner" style="min-height: 500px;">  

                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="detail-box bg-white text-dark p-4 rounded shadow-lg" 
                                    style="background: url('images/t2.jpg') no-repeat center center; 
                                            background-size: cover;
                                            min-height: 500px;">
                                    <h1 class="text-primary text-center fw-bold">Welcome To Pharma360</h1>
                                    <p class="text-dark lead text-center">Order medicines from home with ease.</p>
                                    <ul class="list-unstyled text-dark text-center">
                                        <li>✅ <strong>Easy Ordering</strong> – Browse & buy instantly.</li>
                                        <li>✅ <strong>✅ Doctor Directory</strong>  – Browse expert profiles and details.</li>
                                        <li>✅ <strong>Fast Delivery</strong> – Available across Nashik city.</li>
                                    </ul>
                                    <div class="text-center">
                                        <a href="login.php" class="btn btn-success btn-lg mt-3 shadow-lg px-4 py-2 rounded-pill">
                                            🛒 Buy Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <img src="images/medicine.png" class="img-fluid rounded" alt="medicine image"
                                     style="height: 400px; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <div class="detail-box bg-white text-dark p-4 rounded shadow" style="min-height: 500px;">
                                    <h1 class="text-primary">Wide Range of Medicines</h1>
                                    <p class="lead">Get medicines and health essentials delivered to your doorstep.</p>
                                    <ul class="list-unstyled">
                                        <li>✅ <strong>Authentic Medicines</strong> – Direct from certified suppliers.</li>
                                        <li>✅ <strong>✅ Find Doctors Easily</strong>  – Get information about qualified professionals.</li>
                                        <li>✅ <strong>24/7 Support</strong> – Your health, our priority.</li>
                                    </ul>
                                    <a href="login.php" class="btn btn-dark btn-lg mt-3 shadow">🛒 Order Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <img src="images/logo1.jpg" class="img-fluid rounded" alt="Medicine"
                                     style="height: 400px; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <div class="detail-box bg-white text-dark p-4 rounded shadow" style="min-height: 500px;">
                                    <h1 class="text-primary">About Pharma360</h1>
                                    <p class="lead">Providing reliable healthcare solutions with certified medicines.</p>
                                    <ul class="list-unstyled">
                                        <li>✅ <strong>Trusted by Thousands</strong> – A reliable pharmacy platform.</li>
                                        <li>✅ <strong>Verified Doctors</strong>  – Access trusted doctor details anytime.</li>
                                        <li>✅ <strong>Fast & Safe Delivery</strong> – We deliver across Nashik city.</li>
                                    </ul>
                                    <a href="login.php" class="btn btn-dark btn-lg mt-3 shadow">🛒 Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>

        </div>
    </section>
</main>


<?php include 'footer.php'; ?>


<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myCarousel = document.querySelector('#carouselExampleIndicators');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 3000, 
            ride: 'carousel' 
        });

    
        document.querySelector('.carousel-control-prev').addEventListener('click', function () {
            carousel.prev();
        });

        document.querySelector('.carousel-control-next').addEventListener('click', function () {
            carousel.next();
        });
    });
</script>

</body>
</html>
