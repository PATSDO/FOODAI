<?php
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $allergens = isset($_POST['allergens']) ? implode(", ", $_POST['allergens']) : "";

    // Hash password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email already exists!');</script>";
    } else {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, allergens, password_hash) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $allergens, $password_hash);

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
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="register.php">
        <label>First Name:</label>
        <input type="text" name="first_name" required><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Allergens:</label><br>
        <input type="checkbox" name="allergens[]" value="Peanuts"> Peanuts<br>
        <input type="checkbox" name="allergens[]" value="Dairy"> Dairy<br>
        <input type="checkbox" name="allergens[]" value="Wheat"> Wheat<br>
        <input type="checkbox" name="allergens[]" value="Shellfish"> Shellfish<br>
        <input type="checkbox" name="allergens[]" value="Eggs"> Eggs<br>
        <input type="checkbox" name="allergens[]" value="Soy"> Soy<br>
        <input type="checkbox" name="allergens[]" value="Fish"> Fish<br>
        <input type="checkbox" name="allergens[]" value="Milk"> Milk<br>

        <button type="submit">Register</button>
    </form>
    <br>
    <a href="login.php"><button>Go to Login</button></a>
</body>
</html>
