<?php
session_start();
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $allergen = isset($_POST['allergens']) ? implode(", ", $_POST['allergens']) : "";
    $role = "user"; // Default role for new users

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email already exists!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, allergen, password_hash, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $allergen, $password_hash, $role);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FAI</title>
    <link href="https://img.icons8.com/ios/50/null/food-bar.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        body {
            background: url('img/registerbg.png') no-repeat center center fixed;
            background-size: cover;
        }
        .card {
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.90); /* 70% opacity */
        }
    </style>
</head>
<body>
    <!-- Register -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg border-0" style="width: 400px;">
            <h2 class="text-center text-primary">Register</h2>
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?> </div>
            <?php endif; ?>
            <form action="register.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Allergens:</label> <br>
                    <input type="checkbox" name="allergens[]" value="Peanuts"> Peanuts<br>
                    <input type="checkbox" name="allergens[]" value="Dairy"> Dairy<br>
                    <input type="checkbox" name="allergens[]" value="Wheat"> Wheat<br>
                    <input type="checkbox" name="allergens[]" value="Shellfish"> Shellfish<br>
                    <input type="checkbox" name="allergens[]" value="Eggs"> Eggs<br>
                    <input type="checkbox" name="allergens[]" value="Soy"> Soy<br>
                    <input type="checkbox" name="allergens[]" value="Fish"> Fish<br>
                    <input type="checkbox" name="allergens[]" value="Milk"> Milk<br>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
                <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
