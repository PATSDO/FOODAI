<?php 
session_start();
include 'db_connection.php'; 

// Stops the user in interacting with FAI
if (!isset($_SESSION['first_name'])) {
    echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh; 
                background: url(\"img/warningbg.png\") no-repeat center center; 
                background-size: cover;'>
            <div style='text-align: center; padding: 30px; border-radius: 10px; background: rgba(255, 255, 255, 0.9); 
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); max-width: 400px;'>
                <h2 style='color: #721c24; margin-bottom: 15px;'>Access Denied</h2>
                <p style='color: #721c24; font-size: 18px; margin-bottom: 20px;'>Login to chat with FAI</p>
                <a href='index.php'><button style='font-size: 18px; padding: 10px 20px; margin: 5px;' class='btn btn-secondary'>Back to Home</button></a>
                <a href='login.php'><button style='font-size: 18px; padding: 10px 20px; margin: 5px;' class='btn btn-primary'>Login</button></a>
            </div>
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
    
    <!-- Additional Custom Styling -->
    <style>
        /* Replace the existing <style> section with this code */
        :root {
            --primary-color: #000000; /* Black instead of sky blue */
            --secondary-color: #1a1a1a; /* Dark gray instead of light grayish blue */
            --accent-color: #FF6B00; /* Vibrant orange accent */
            --text-color: #ffffff; /* White for text */
            --light-bg: #0d0d0d; /* Very dark gray background */
            --dark-bg: #1a1a1a; /* Slightly lighter dark gray */
            --success-color: #1f3d2d; /* Dark green */
            --warning-color: #3d3319; /* Dark yellow */
            --danger-color: #3d1919; /* Dark red */
        }

        body {
            color: var(--text-color);
            background-color: #000000;
            font-family: 'Open Sans', sans-serif;
        }

        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        .bg-secondary {
            background-color: var(--secondary-color) !important;
        }

        .text-primary {
            color: var(--accent-color) !important; /* Orange for primary text */
        }

        h1, h2, h3, h4, h5, h6, p, span, div {
            color: #ffffff !important; /* Make all text white by default */
        }

        .display-6, .section-title h4 {
            color: #ffffff !important; /* Ensure "I'll be your assistant today" is white */
        }

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #FF8534;
            border-color: #FF8534;
        }

        .btn-danger {
            background-color: #3d1919;
            border-color: #3d1919;
        }

        .btn-danger:hover {
            background-color: #4f2020;
            border-color: #4f2020;
        }

        /* Enhanced Elements */
        .animated-title {
            animation: fadeIn 1.2s ease-in-out;
        }

        .chat-box-enhanced {
            border-radius: 15px !important;
            box-shadow: 0 4px 12px rgba(255,255,255,0.05) !important;
            transition: all 0.3s ease !important;
            background-color: #111111 !important;
        }

        .fai-text {
            animation: slideInLeft 0.4s ease-out;
            background-color: #0d0d0d;
            border-radius: 15px;
            padding: 12px;
            margin-bottom: 10px !important;
            border-left: 3px solid var(--accent-color);
            color: white;
        }

        .user-text {
            animation: slideInRight 0.4s ease-out;
            background-color: #1a1a1a;
            border-radius: 15px;
            padding: 12px;
            margin-bottom: 10px !important;
            border-right: 3px solid var(--accent-color);
            text-align: right;
            color: white;
        }

        .chat-header {
            background-color: #000000;
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 12px;
            margin-bottom: 0 !important;
        }

        .restaurant-link {
            position: relative;
            transition: color 0.3s ease;
            color: #aaaaaa !important;
        }

        .restaurant-link:after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--accent-color);
            transition: width 0.3s ease;
        }

        .restaurant-link:hover {
            color: var(--accent-color) !important;
        }

        .restaurant-link:hover:after {
            width: 100%;
        }

        .gentle-pulse {
            animation: gentle-pulse 3s infinite;
        }

        .shadow-hover {
            transition: all 0.3s ease;
            border-radius: 15px;
            background-color: #0d0d0d;
        }

        .shadow-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255,255,255,0.08);
        }

        .icon-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: rgba(255, 107, 0, 0.3);
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .icon-container:hover {
            background-color: rgba(255, 107, 0, 0.5);
            transform: scale(1.1);
        }

        .icon-container i {
            color: var(--accent-color) !important;
        }

        /* Chat animation */
        .typing-indicator {
            display: inline-block;
            margin-left: 5px;
        }

        .typing-indicator span {
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: var(--accent-color);
            border-radius: 50%;
            animation: typing 1s infinite;
            margin: 0 2px;
        }

        .typing-indicator span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-indicator span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {
            0% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0); }
        }

        /* Navigation styling */
        .navbar {
            background-color: #000000 !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .navbar .nav-link {
            color: #aaaaaa !important;
        }

        .navbar .nav-link.active {
            color: var(--accent-color) !important;
        }

        /* Page header styling */
        .bg-dark.bg-img {
            background: linear-gradient(135deg, #000000, #1a1a1a) !important;
            background-size: cover !important;
        }

        /* Footer styling */
        .bg-img {
            background: linear-gradient(135deg, #000000, #1a1a1a) !important;
            color: white !important;
        }

        .text-secondary {
            color: #aaaaaa !important;
        }

        .border-inner {
            border: none !important;
            border-radius: 15px;
        }

        /* Chat container */
        .chat-container {
            background: linear-gradient(135deg, #0d0d0d, #1a1a1a) !important;
            border: none !important;
            border-radius: 15px;
        }

        /* Back to top button */
        .back-to-top {
            background-color: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
        }

        .back-to-top:hover {
            background-color: #FF8534;
        }

        /* Feature cards */
        .card {
            border-radius: 15px;
            overflow: hidden;
            background-color: #111111;
            color: white;
        }

        /* Form controls */
        .form-control {
            background-color: #111111;
            border-color: #333333;
            color: white;
        }

        .form-control:focus {
            background-color: #111111;
            border-color: var(--accent-color);
            color: white;
        }

        /* Dropdown styling */
        .dropdown-menu {
            background-color: #111111;
        }

        .dropdown-item {
            color: #aaaaaa;
        }

        .dropdown-item:hover {
            background-color: #1a1a1a;
            color: var(--accent-color);
        }

        /* Footer override */
        .container-fluid.py-4 {
            background: #000000 !important;
        }

        /* Specific header override */
        .section-title h1 {
            color: var(--accent-color) !important;
        }

        .fas, .bi {
            color: var(--accent-color) !important;
        }

        strong {
            color: var(--accent-color) !important;
        }
    </style>
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
            <div class="col-lg-4 text-center bg-primary border-inner py-4">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <a href="index.php" class="navbar-brand">
                        <h1 style="font-family: Times New Roman" class="m-0 text-uppercase text-white gentle-pulse"><i class="fas fa-utensils me-2"></i>Food AI</h1>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center bg-secondary py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <div class="text-start">
                        <?php if (isset($_SESSION['first_name'])): ?>
                            <h6 class="text-black">Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</h6>
                            <a href="logout.php"><button style="font-family: Times New Roman" type="button" class="btn btn-danger btn-lg shadow-hover">Logout</button></a>
                        <?php else: ?>
                            <a href="register.php"><button style="font-family: Times New Roman" type="button" class="btn btn-primary btn-lg shadow-hover me-2">Register</button></a>
                            <a href="login.php"><button style="font-family: Times New Roman" type="button" class="btn btn-primary btn-lg shadow-hover">Login</button></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0">
        <a href="index.php" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 text-uppercase text-white"><i class="fas fa-utensils text-primary me-3"></i>FAI</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto mx-lg-auto py-0">
                <a style="font-family: Times New Roman" href="index.php" class="nav-item nav-link restaurant-link">Home</a>
                <a style="font-family: Times New Roman" href="about.php" class="nav-item nav-link active restaurant-link">FAI</a>
                <a style="font-family: Times New Roman" href="menu.php" class="nav-item nav-link restaurant-link">Jollibee</a>
                <a style="font-family: Times New Roman" href="menu2.php" class="nav-item nav-link restaurant-link">Mcdonalds</a>
                <a style="font-family: Times New Roman" href="menu3.php" class="nav-item nav-link restaurant-link">KFC</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 style="font-family: Times New Roman" class="display-4 text-uppercase text-white animated-title">FAI</h1>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- About Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3 gentle-pulse" style="max-width: 600px;">
                <h1 class="text-primary font-secondary">Hello I am FAI!</h1>
                <h4 class="display-6 text-uppercase">I'll be your assistant today.</h4>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Chatbot Section -->
    <h2 class="text-center text-primary animated-title">AI Chatbot</h2>
    <div class="chat-container shadow-hover" style="max-width: 800px; margin: auto;">
        <div class="chat-header text-center">
            <i class="fas fa-robot me-2"></i>
            <h5 class="d-inline-block mb-0">Food Allergy Assistant</h5>
        </div>
        <div class="chat-box chat-box-enhanced" id="chat-box" style="height: 300px; overflow-y: auto; padding: 15px;"></div>
        <div class="d-flex mt-3">
            <input type="text" id="user-input" class="form-control me-2" placeholder="Type a message..." onkeypress="handleKeyPress(event)">
            <button class="btn btn-primary" onclick="sendMessage()"><i class="fas fa-paper-plane me-1"></i> Send</button>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-hover">
                    <div class="card-body text-center">
                        <div class="icon-container">
                            <i class="fas fa-utensils text-primary fa-2x"></i>
                        </div>
                        <h4>Restaurant Menus</h4>
                        <p>Access menus from Jollibee, McDonald's, and KFC to find suitable options.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-hover">
                    <div class="card-body text-center">
                        <div class="icon-container">
                            <i class="fas fa-allergies text-primary fa-2x"></i>
                        </div>
                        <h4>Allergy Information</h4>
                        <p>Find out which menu items contain common allergens that might affect you.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-hover">
                    <div class="card-body text-center">
                        <div class="icon-container">
                            <i class="fas fa-check-circle text-primary fa-2x"></i>
                        </div>
                        <h4>Safe Recommendations</h4>
                        <p>Get personalized recommendations that match your dietary requirements.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            const chatBox = document.getElementById("chat-box");
            chatBox.innerHTML += `<div class='fai-text mb-2'><strong>FAI:</strong> Hi there! I'm Fai, your Food Allergy Assistant. I can check menu items from Jollibee, McDonalds, and KFC against your allergies. How can I help?</div>`;
        };

        async function sendMessage() {
            const inputField = document.getElementById("user-input");
            const message = inputField.value.trim();
            if (!message) return;

            const chatBox = document.getElementById("chat-box");
            chatBox.innerHTML += `<div class='user-text mb-2'><strong>You:</strong> ${message}</div>`;
            inputField.value = "";
            
            // Show typing indicator
            const typingIndicator = document.createElement("div");
            typingIndicator.className = "fai-text mb-2";
            typingIndicator.id = "typing-indicator";
            typingIndicator.innerHTML = `<strong>FAI:</strong> <div class="typing-indicator"><span></span><span></span><span></span></div>`;
            chatBox.appendChild(typingIndicator);
            chatBox.scrollTop = chatBox.scrollHeight;
            
            try {
                const response = await fetch("http://localhost:5000/chat", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ message: message })
                });

                const data = await response.json();
                
                // Remove typing indicator
                document.getElementById("typing-indicator").remove();
                
                chatBox.innerHTML += `<div class='fai-text mb-2'><strong>FAI:</strong> ${data.message}</div>`;
            } catch (error) {
                // Remove typing indicator
                document.getElementById("typing-indicator").remove();
                
                chatBox.innerHTML += `<div class='fai-text text-danger mb-2'><strong>FAI:</strong> Error connecting to assistant</div>`;
            }
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function handleKeyPress(event) {
            if (event.key === "Enter") sendMessage();
        }
    </script>

    <!-- Footer Start -->
    <div class="container-fluid bg-img text-white" style="margin-top: 90px">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4 col-md-6 mb-lg-n5">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary border-inner p-4 shadow-hover">
                        <a href="index.html" class="navbar-brand">
                            <h1 class="m-0 text-uppercase text-white"><i class="fas fa-utensils me-2"></i>Food AI</h1>
                        </a>
                        <p class="mt-3">Discover the best local dining experiences tailored just for you! FAI (Food AI) is an intelligent food recommendation system that uses artificial intelligence to suggest personalized meal options based on your preferences, dietary needs, and real-time availability from nearby fast food restaurants.</p>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-12 pt-5 mb-5">
                            <h4 class="text-white text-uppercase mb-4">Get In Touch</h4>
                            <div class="d-flex mb-2">
                                <i class="bi bi-geo-alt text-white me-2"></i>
                                <p class="mb-0">123 Street, Manila</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-white me-2"></i>
                                <p class="mb-0">foodai@gmail.com</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-white me-2"></i>
                                <p class="mb-0">+012 345 67890</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-white text-uppercase mb-4">Quick Links</h4>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white mb-2" href="index.php"><i class="bi bi-arrow-right text-white me-2"></i>Home</a>
                                <a class="text-white mb-2" href="about.php"><i class="bi bi-arrow-right text-white me-2"></i>FOODAI</a>
                                <a class="text-white mb-2" href="menu.php"><i class="bi bi-arrow-right text-white me-2"></i>Jollibee</a>
                                <a class="text-white mb-2" href="menu2.php"><i class="bi bi-arrow-right text-white me-2"></i>McDonald's</a>
                                <a class="text-white mb-2" href="menu3.php"><i class="bi bi-arrow-right text-white me-2"></i>KFC</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-white text-uppercase mb-4">Email Us</h4>
                            <p>foodai@gmail.com</p>
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
    <div class="container-fluid py-4" style="background: #5C7D99;">
        <div class="container text-center">
            <p class="mb-0 text-white">&copy; <a class="text-white border-bottom" href="index.php">Food AI</a>. by Cipriano, Bandal, De Ocampo, Gesmundo, & Pua</p>
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