<?php
session_start();
require 'db_connection.php';

if (!isset($_GET['id'])) {
    die("Menu ID is required.");
}

$id = intval($_GET['id']);
$query = "SELECT * FROM menu WHERE id = $id";
$result = mysqli_query($conn, $query);
$menu = mysqli_fetch_assoc($result);

if (!$menu) {
    die("Menu item not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $restaurant_name = mysqli_real_escape_string($conn, $_POST['restaurant_name']);
    $food_name = mysqli_real_escape_string($conn, $_POST['food_name']);
    $allergen = mysqli_real_escape_string($conn, $_POST['allergen']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $update_query = "UPDATE menu SET 
                        restaurant_name='$restaurant_name', 
                        food_name='$food_name', 
                        allergen='$allergen', 
                        description='$description' 
                     WHERE id=$id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Menu item updated successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Menu - FAI</title>

    <link href="https://img.icons8.com/ios/50/null/food-bar.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Edit Menu -->
    <h2>Edit Menu Item</h2>
    <form method="POST">
        <label>Restaurant Name:</label>
        <input type="text" name="restaurant_name" value="<?= htmlspecialchars($menu['restaurant_name']) ?>" required>
        <br>

        <label>Food Name:</label>
        <input type="text" name="food_name" value="<?= htmlspecialchars($menu['food_name']) ?>" required>
        <br>

        <label>Allergen:</label>
        <input type="text" name="allergen" value="<?= htmlspecialchars($menu['allergen']) ?>">
        <br>

        <label>Description:</label>
        <textarea name="description" required><?= htmlspecialchars($menu['description']) ?></textarea>
        <br>

        <button type="submit">Update Menu Item</button>
    </form>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
