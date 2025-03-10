<?php
session_start();
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $restaurant_name = mysqli_real_escape_string($conn, $_POST['restaurant_name']);
    $food_name = mysqli_real_escape_string($conn, $_POST['food_name']);
    $allergen = mysqli_real_escape_string($conn, $_POST['allergen']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $query = "INSERT INTO menu (restaurant_name, food_name, allergen, description) 
              VALUES ('$restaurant_name', '$food_name', '$allergen', '$description')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Menu item added successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add Menu - FAI</title>

    <link href="https://img.icons8.com/ios/50/null/food-bar.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Add Menu -->
    <h2>Add Menu Item</h2>
    <form method="POST" action="add_menu.php">
        <label>Restaurant Name:</label>
        <input type="text" name="restaurant_name" required>
        <br>

        <label>Food Name:</label>
        <input type="text" name="food_name" required>
        <br>

        <label>Allergen:</label>
        <input type="text" name="allergen">
        <br>

        <label>Description:</label>
        <textarea name="description" required></textarea>
        <br>

        <button type="submit">Add Menu Item</button>
    </form>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
