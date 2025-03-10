<?php
session_start();
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, first_name, password_hash, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $first_name, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;

            if ($role === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Invalid credentials!";
        }
    } else {
        $_SESSION['error'] = "User not found!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FAI</title>
    <link href="https://img.icons8.com/ios/50/null/food-bar.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        body {
            background: url('img/loginbg.png') no-repeat center center fixed;
            background-size: cover;
        }
        .card {
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.90); /* 70% opacity */
        }
    </style>
</head>
<body>
    <!-- Login -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg border-0" style="width: 400px;">
            <h2 class="text-center text-primary">Login</h2>
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                
                <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register</a></p>
            </form>
        </div>
    </div>
</body>
</html>
