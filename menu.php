<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Jollibee - FAI</title>

    <link href="https://img.icons8.com/ios/50/null/food-bar.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid px-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-4 text-center bg-secondary py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-envelope fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 style="font-family: Times New Roman" class="text-uppercase mb-1">Email Us</h6>
                        <span>foodai@gmail.com</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center bg-primary border-inner py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <a href="index.php" class="navbar-brand">
                        <h1 style="font-family: Times New Roman" class="m-0 text-uppercase text-white">Food AI</h1>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center bg-secondary py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <div class="text-start">
                        <?php if (isset($_SESSION['first_name'])): ?>
                            <h6 class="text-black">Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</h6>
                            <a href="logout.php"><button style="font-family: Times New Roman" type="button" class="btn btn-danger btn-lg">Logout</button></a>
                        <?php else: ?>
                            <a href="register.php"><button style="font-family: Times New Roman" type="button" class="btn btn-primary btn-lg">Register</button></a>
                            <a href="login.php"><button style="font-family: Times New Roman" type="button" class="btn btn-primary btn-lg">Login</button></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0">
        <a href="index.php" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 text-uppercase text-white"><i class=" text-primary me-3"></i>FAI</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto mx-lg-auto py-0">
                <a style="font-family: Times New Roman" href="index.php" class="nav-item nav-link">Home</a>
                <a style="font-family: Times New Roman"  href="about.php" class="nav-item nav-link">FAI</a>
                <a style="font-family: Times New Roman"  href="menu.php" class="nav-item nav-link active">Jollibee</a>
                <a style="font-family: Times New Roman"  href="menu2.php" class="nav-item nav-link">Mcdonalds</a>
                <a style="font-family: Times New Roman"  href="menu3.php" class="nav-item nav-link">KFC</a>
                <div class="nav-item dropdown">
                    <a style="font-family: Times New Roman"  href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Orders</a>
                    <div class="dropdown-menu m-0">
                        <a href="service.html" class="dropdown-item">History</a>
                        <a href="testimonial.html" class="dropdown-item">Reviews</a>
                    </div>
                </div>
                <a style="font-family: Times New Roman"  href="contact.html" class="nav-item nav-link">Contact Us</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 style="font-family: Times New Roman" class="display-4 text-uppercase text-white">Jollibee</h1>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Products Start -->
    <div class="container-fluid about py-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <img class="img-fluid" src="img/jollibee-logo.png" alt="" style="width: 220px; height: 220px;">
                <br>
                <br>
                <h2 class="text-primary font-secondary">The Menu </h2>
                <h1 style="font-family: Times New Roman; font-size: 50px" class="display-4 ">Bida ang saya!</h1>
            </div>
            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center bg-dark text-uppercase border-inner p-4 mb-5">
                    <li class="nav-item">
                        <a class="nav-link text-white active" data-bs-toggle="pill" href="#tab-1">Chickenjoy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " data-bs-toggle="pill" href="#tab-2">Burgers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" data-bs-toggle="pill" href="#tab-3">Snacks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" data-bs-toggle="pill" href="#tab-4">Desserts & Drinks</a>
                    </li>
                <!--- tab 1---->
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="d-flex h-100">
                                    <div class="flex-shrink-0">
                                        <a class="nav-item nav-link"> <img class="img-fluid" src="img/chicken/6-pc-Chickenjoy-Solo.webp" alt="" style="width: 200px; height: 229px;"> </a>
                                        <h4 style="font-family: Times New Roman" class="bg-dark text-primary p-2 m-0">₱449.00</h4>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                        <h5 style="font-family: Times New Roman" class="text-uppercase">6 - pc. Chickenjoy Solo</h5>
                                        <span>Allergens:<br>- Wheat/Gluten<br>- Milk/Dairy<br>- Soy<br> - Eggs</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex h-100">
                                    <div class="flex-shrink-0">
                                        <a class="nav-item nav-link"> <img class="img-fluid" src="img/chicken/Jolly-Super-Meal.webp" alt="" style="width: 200px; height: 229px;"> </a>
                                        <h4 style="font-family: Times New Roman" class="bg-dark text-primary p-2 m-0">₱191.00</h4>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                        <h5 style="font-family: Times New Roman" class="text-uppercase">Jollibee Super Meal</h5>
                                        <span>Allergens:<br>- Wheat/Gluten<br>- Milk/Dairy<br>- Soy<br> - Eggs</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex h-100">
                                    <div class="flex-shrink-0">
                                        <a class="nav-item nav-link"> <img class="img-fluid" src="img/chicken/2-pcs-chicken.webp" alt="" style="width: 200px; height: 229px;"> </a>
                                        <h4 style="font-family: Times New Roman" class="bg-dark text-primary p-2 m-0">₱163.00</h4>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                        <h5 style="font-family: Times New Roman" class="text-uppercase">2 - pc. Chickenjoy w/ Drink</h5>
                                        <span>Allergens:<br>- Wheat/Gluten<br>- Milk/Dairy<br>- Soy<br> - Eggs</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex h-100">
                                    <div class="flex-shrink-0">
                                        <a class="nav-item nav-link"> <img class="img-fluid" src="img/chicken/1-pc-spaghetti.webp" alt="" style="width: 200px; height: 229px;"> </a>
                                        <h4 style="font-family: Times New Roman" class="bg-dark text-primary p-2 m-0">₱251.00</h4>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                        <h5 style="font-family: Times New Roman" class="text-uppercase">1 - pc. Chickenjoy w/ Jolly Spaghetti</h5>
                                        <span>Allergens:<br>- Wheat/Gluten<br>- Milk/Dairy<br>- Soy<br> - Eggs</span>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                 <!--- tab 2---->

                    <div id="tab-2" class="tab-pane fade show p-0 ">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="d-flex h-100">
                                    <div class="flex-shrink-0">
                                        <a class="nav-item nav-link"> <img class="img-fluid" src="img/burger/Yumburger-Solo.png" alt="" style="width: 210px; height: 229px;"> </a>
                                        <h4 style="font-family: Times New Roman" class="bg-dark text-primary p-2 m-0">$399.00</h4>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                        <h5 style="font-family: Times New Roman" class="text-uppercase">Yumburger</h5>
                                        <span>Allergens: <br>- Wheat/Gluten <br>- Eggs<br>- Soy</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex h-100">
                                    <div class="flex-shrink-0">
                                        <a class="nav-item nav-link"> <img class="img-fluid" src="img/burger/Cheesy-Yumburger-Solo.png" alt="" style="width: 210px; height: 229px;"> </a>
                                        <h4 style="font-family: Times New Roman"  class="bg-dark text-primary p-2 m-0">$99.00</h4>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                        <h5 style="font-family: Times New Roman" class="text-uppercase">Cheesy Yumburger</h5>
                                        <span>Allergens: <br>- Wheat/Gluten <br>- Eggs<br>- Soy<br>- Milk/Dairy</span>
                                    </div>
                                </div>
                            </div>
                            <center>
                            <div class="col-lg-6">
                                <div class="d-flex h-100">
                                    <div class="flex-shrink-0">
                                        <a  class="nav-item nav-link"> <img class="img-fluid" src="img/burger/Champ-1.webp" alt="" style="width: 210px; height: 229px;"> </a>
                                        <h4 style="font-family: Times New Roman" class="bg-dark text-primary p-2 m-0">$99.00</h4>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                        <h5 style="font-family: Times New Roman" class="text-uppercase">Champ</h5>
                                        <span>Allergens: <br>- Wheat/Gluten <br>- Eggs<br>- Soy<br>- Milk/Dairy</span>
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                    </div>
                
                 <!--- tab 3---->

            
                    <div id="tab-3" class="tab-pane fade show p-0 ">
                            <div class="row g-3">
                                <div class="col-lg-6">
                                    <div class="d-flex h-100">
                                        <div class="flex-shrink-0">
                                            <a class="nav-item nav-link"> <img class="img-fluid" src="img/snacks/Jolly-Spaghetti-Solo.webp" alt="" style="width: 210px; height: 229px;"> </a>
                                            <h4 style="font-family: Times New Roman" class="bg-dark text-primary p-2 m-0">$299.00</h4>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                            <h5 style="font-family: Times New Roman" class="text-uppercase">Jolly Spaghetti</h5>
                                            <span>Allergens: <br>- Milk/Dairy<br>- Gluten</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex h-100">
                                        <div class="flex-shrink-0">
                                            <a  class="nav-item nav-link"> <img class="img-fluid" src="img/snacks/Cheesy-Classic-Jolly-Hotdog-Solo.webp" alt="" style="width: 210px; height: 229px;"> </a>
                                            <h4 style="font-family: Times New Roman" class="bg-dark text-primary p-2 m-0">$499.00</h4>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                            <h5 style="font-family: Times New Roman" class="text-uppercase">Jolly Hotdog</h5>
                                            <span>Allergens: <br>- Milk/Dairy<br>- Gluten<br>- Soy<br>- Egg<br>- Celery<br>- Mustard</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex h-100">
                                        <div class="flex-shrink-0">
                                            <a class="nav-item nav-link"> <img class="img-fluid" src="img/snacks/Peach-Mango-Pie.png" alt="" style="width: 210px; height: 229px;"> </a>
                                            <h4 style="font-family: Times New Roman" class="bg-dark text-primary p-2 m-0">$499.00</h4>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                            <h5 style="font-family: Times New Roman" class="text-uppercase">Peach Mango Pie</h5>
                                            <span>Allergens: <br>- Wheat/Gluten<br>- Soy<br>- Milk/Dairy</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="d-flex h-100">
                                        <div class="flex-shrink-0">
                                            <a class="nav-item nav-link"> <img class="img-fluid" src="img/snacks/Palabok-Solo.webp" alt="" style="width: 210px; height: 229px;"> </a>
                                            <h4 style="font-family: Times New Roman" class="bg-dark text-primary p-2 m-0">$189.00</h4>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                            <h5 style="font-family: Times New Roman" class="text-uppercase">Palabok</h5>
                                            <span>Allergens: <br>- Wheat/Gluten<br>- Soy<br>- Egg<br>- Milk/Dairy<br>- Fish<br>- Shellfish</span>
                                        </div>
                                    </div>
                                </div>
                                
                    
                            
                            </div>
                        </div>
                    
                     
                     <!--- tab 4---->
                    
                    <div id="tab-4" class="tab-pane fade show p-0 ">
                            <div class="row g-3">
                                <div class="col-lg-6">
                                    <div class="d-flex h-100">
                                        <div class="flex-shrink-0">
                                            <a class="nav-item nav-link"> <img class="img-fluid" src="img/desserts/Chocolate-Sundae-Twirl.webp" alt="" style="width: 210px; height: 229px;"> </a>
                                            <h4 style="font-family: Times New Roman" class="bg-dark text-primary p-2 m-0">$299.00</h4>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                            <h5 style="font-family: Times New Roman" class="text-uppercase">Chocolate Sundae Twirl</h5>
                                            <span>Allergens: <br>- Milk/Dairy</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex h-100">
                                        <div class="flex-shrink-0">
                                            <a class="nav-item nav-link"> <img class="img-fluid" src="img/desserts/Coke-Float.webp" alt="" style="width: 210px; height: 229px;"> </a>
                                            <h4 style="font-family: Times New Roman" class="bg-dark text-primary p-2 m-0">$499.00</h4>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                            <h5 style="font-family: Times New Roman" class="text-uppercase">Coke Float</h5>
                                            <span>Allergens: <br>- Milk/Dairy</span>
                                        </div>
                                    </div>
                                </div>
                                <center>
                                <div class="col-lg-6">
                                    <div class="d-flex h-100">
                                        <div class="flex-shrink-0">
                                            <a class="nav-item nav-link"> <img class="img-fluid" src="img/desserts/Coke-Regular.webp" alt="" style="width: 210px; height: 229px;"> </a>
                                            <h4 style="font-family: Times New Roman" class="bg-dark text-primary p-2 m-0">$189.00</h4>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center text-start bg-secondary border-inner px-4" style="height: 290px; width: 500px;">
                                            <h5 style="font-family: Times New Roman" class="text-uppercase">Coke</h5>
                                            <span>Allergens: <br>- No Allergens</span>
                                        </div>
                                    </div>
                                </div>
                                </center>
                    
                            
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


    <!-- Offer Start -->
    <div class="container-fluid bg-offer my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title position-relative text-center mx-auto mb-4 pb-3" style="max-width: 600px;">
                        <h2 class="text-primary font-secondary">Background</h2>
                        <i><h1 style="font-family: Times New Roman" class="display-4  text-white">About Jollibee</h1></i>
                    </div>
                    <p class="text-white mb-4">Jollibee is the largest fast food chain brand in the Philippines, operating a network of more than 1,500 stores in 17 countries. A dominant market leader in the Philippines, Jollibee enjoys the lion’s share of the local market that is more than all the other multinational fast food brands in PH combined. With a strict adherence to the highest standards of food quality, service and cleanliness, Jollibee serves great-tasting, high-quality and affordable food products to include its superior-tasting Chickenjoy, mouth-watering Yumburger, and deliciously satisfying Jolly Spaghetti among other delicious products.<br><br>Jollibee has embarked on an aggressive international expansion plan, with more than 270 international branches in the United States, Canada, Hong Kong, Macau, Brunei, Vietnam, Singapore, Malaysia, Saudi Arabia, United Arab Emirates, Qatar, Oman, Kuwait, Bahrain, Italy, Spain, and in the United Kingdom.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->
    



        
<!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h1 style="font-family:Times New Roman"class="display-4 ">Know more about Jollibee:</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class=" testimonial-item bg-dark text-white ">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid flex-shrink-0" src="img/jollibeeslide1.webp" style="width: 500px; height: 500px;">
                        <div class="ps-3">
                        
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-dark text-white ">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid flex-shrink-0" src="img/jollibeeslide2.webp" style="width: 500px; height: 500px;">
                        <div class="ps-3">
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-dark text-white ">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid flex-shrink-0" src="img/jollibeeslide3.jpeg" style="width: 500px; height: 420px;">
                        <div class="ps-3">
                            
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-dark text-white">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid flex-shrink-0" src="img/jollibeeslide4.jpg" style="width: 400px; height: 500px;">
                        <div class="ps-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
        
 

    <!-- Footer Start -->
    <div class="container-fluid bg-img text-secondary" style="margin-top: 135px">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4 col-md-6 mt-lg-n5">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary border-inner p-4">
                        <a href="index.html" class="navbar-brand">
                            <h1 class="m-0 text-uppercase text-white"><i class="fa fa-birthday-cake fs-1 text-dark me-3"></i>Food AI</h1>
                        </a>
                        <p class="mt-3">Discover the best local dining experiences tailored just for you! FAI (Food AI) is an intelligent food recommendation system that uses artificial intelligence to suggest personalized meal options based on your preferences, dietary needs, and real-time availability from nearby fast food restaurants.</p>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-12 pt-5 mb-5">
                            <h4 class="text-primary text-uppercase mb-4">Get In Touch</h4>
                            <div class="d-flex mb-2">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                <p class="mb-0">123 Street, New York, USA</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-primary me-2"></i>
                                <p class="mb-0">info@example.com</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                <p class="mb-0">+012 345 67890</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-primary text-uppercase mb-4">Quick Links</h4>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-secondary mb-2" href="index.html"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                                <a class="text-secondary mb-2" href="about.php"><i class="bi bi-arrow-right text-primary me-2"></i>FOODAI</a>
                                <a class="text-secondary mb-2" href="menu.html"><i class="bi bi-arrow-right text-primary me-2"></i>Jollibee</a>
                                <a class="text-secondary mb-2" href="menu2.html"><i class="bi bi-arrow-right text-primary me-2"></i>Mcdonalds</a>
                                <a class="text-secondary mb-2" href="menu3.html"><i class="bi bi-arrow-right text-primary me-2"></i>KFC</a>
                                <a class="text-secondary" href="contact.html"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-primary text-uppercase mb-4">Newsletter</h4>
                            <p>Amet justo diam dolor rebum lorem sit stet sea justo kasd</p>
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control border-white p-3" placeholder="Your Email">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-secondary py-4" style="background: #111111;">
        <div class="container text-center">
            <p class="mb-0">&copy; <a class="text-white border-bottom" href="index.html">Food AI</a>. by Cipriano, Bandal, De Ocampo, Gesmundo, & Pua</a></p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-inner py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
