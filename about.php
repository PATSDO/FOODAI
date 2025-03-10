<?php 
session_start();
include 'db_connection.php'; 

// Stops the user in interacting with FAI
if (!isset($_SESSION['first_name'])) {
    echo "<div style='text-align: center; padding: 50px; font-size: 24px;'>
            <p>Login to chat with FAI</p>
            <a href='index.php'><button style='font-size: 18px; padding: 10px 20px;' class='btn btn-primary'>Back to Home</button></a>
            <a href='login.php'><button style='font-size: 18px; padding: 10px 20px;' class='btn btn-primary'>Login</button></a>
          </div>";
    exit(); // Stop further execution
}
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FAI Chatbot - FAI</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="https://img.icons8.com/ios/50/null/food-bar.png" rel="icon">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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
                        <h1 style="font-family: Times New Roman" class="m-0 text-uppercase text-white"><i class="fs-1 text-dark me-3"></i>Food AI</h1>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center bg-secondary py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <div class="text-start">
                        <h6 class="text-black">Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</h6>
                        <a href="logout.php"><button style="font-family: Times New Roman" type="button" class="btn btn-danger btn-lg">Logout</button></a>
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
                <a style="font-family: Times New Roman"  href="about.php" class="nav-item nav-link active">FAI</a>
                <a style="font-family: Times New Roman"  href="menu.php" class="nav-item nav-link">Jollibee</a>
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
    <!-- Navbar End --><!-- Changed to php -->

    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 style="font-family: Times New Roman"class="display-4 text-uppercase text-white">FAI</h1>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h1 class="text-primary font-secondary">Hello I am FAI!</h1>
                <h4 class="display-6 text-uppercase">I'll be your assistant today.</h4>
            </div>
        </div>
    </div>
    <!-- About End -->


     <!-- Chatbot Section -->
    <h2 class="text-center text-primary">AI Chatbot</h2>
    <div class="chat-container border rounded p-3 bg-dark" style="max-width: 800px; margin: auto;">
        <div class="chat-box" id="chat-box" style="height: 300px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; background: white;"></div>
        <div class="d-flex mt-2">
            <input type="text" id="user-input" class="form-control me-2" placeholder="Type a message..." onkeypress="handleKeyPress(event)">
            <button class="btn btn-primary" onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
        window.onload = function() {
            const chatBox = document.getElementById("chat-box");
            chatBox.innerHTML += `<div class='text-start fai-text mb-2'><strong>fai:</strong> Hi there! I'm Fai, your Food Allergy Assistant. I can check menu items from Jollibee, McDonalds, and KFC against your allergies. How can I help?</div>`;
        };

        async function sendMessage() {
            const inputField = document.getElementById("user-input");
            const message = inputField.value.trim();
            if (!message) return;

            const chatBox = document.getElementById("chat-box");
            chatBox.innerHTML += `<div class='text-end text-dark mb-2'><strong>You:</strong> ${message}</div>`;
            inputField.value = "";
            
            try {
                const response = await fetch("http://localhost:5000/chat", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ message: message })
                });

                const data = await response.json();
                chatBox.innerHTML += `<div class='text-start fai-text mb-2'><strong>fai:</strong> ${data.message}</div>`;
            } catch (error) {
                chatBox.innerHTML += `<div class='text-start text-danger mb-2'><strong>fai:</strong> Error connecting to assistant</div>`;
            }
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function handleKeyPress(event) {
            if (event.key === "Enter") sendMessage();
        }
    </script>

   

 <!-- Footer Start -->
    <div class="container-fluid bg-img text-secondary" style="margin-top: 90px">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4 col-md-6 mb-lg-n5">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary border-inner p-4">
                        <a href="index.php" class="navbar-brand">
                            <h1 class="m-0 text-uppercase text-white"></i>Food AI</h1>
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
                                <p class="mb-0">123 Street, Manila</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-primary me-2"></i>
                                <p class="mb-0">foodai@gmail.com</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                <p class="mb-0">+012 345 67890</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-primary text-uppercase mb-4">Quick Links</h4>
                            <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="index.php"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                                <a class="text-secondary mb-2" href="about.php"><i class="bi bi-arrow-right text-primary me-2"></i>FOODAI</a>
                                <a class="text-secondary mb-2" href="menu.php"><i class="bi bi-arrow-right text-primary me-2"></i>Jollibee</a>
                                <a class="text-secondary mb-2" href="menu2.php"><i class="bi bi-arrow-right text-primary me-2"></i>Mcdonalds</a>
                                <a class="text-secondary mb-2" href="menu3.php"><i class="bi bi-arrow-right text-primary me-2"></i>KFC</a>
                                <a class="text-secondary" href="contact.html"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-primary text-uppercase mb-4">Email Us</h4>
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
            <p class="mb-0">&copy; <a class="text-white border-bottom" href="#">Food AI</a>. by Cipriano, Bandal, De Ocampo, Gesmundo, & Pua</p>
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
