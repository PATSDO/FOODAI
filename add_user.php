<?php
session_start();
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $allergen = mysqli_real_escape_string($conn, $_POST['allergen']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $query = "INSERT INTO users (first_name, last_name, email, allergen, password_hash, role) 
              VALUES ('$first_name', '$last_name', '$email', '$allergen', '$password', '$role')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('User added successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add User - FAI</title>

    <link href="https://img.icons8.com/ios/50/null/food-bar.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body> 
    <!-- Add User -->
    <h2>Add User</h2>
    <form method="POST" action="add_user.php">
        <label>First Name:</label>
        <input type="text" name="first_name" required>
        <br>

        <label>Last Name:</label>
        <input type="text" name="last_name" required>
        <br>

        <label>Email:</label>
        <input type="email" name="email" required>
        <br>

        <label>Allergen:</label>
        <input type="text" name="allergen">
        <br>

        <label>Password:</label>
        <input type="password" name="password" required>
        <br>

        <label>Role:</label>
        <select name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <br>

        <button type="submit">Add User</button>
    </form>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
