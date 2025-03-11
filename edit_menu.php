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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-orange {
            background-color: #ff8c00;
            color: white;
            border: none;
        }
        .btn-orange:hover {
            background-color: #e07b00;
        }
        body{
            background: url('img/editmenubg.png') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Edit Menu Item</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Restaurant Name:</label>
                    <input type="text" name="restaurant_name" class="form-control" value="<?= htmlspecialchars($menu['restaurant_name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Food Name:</label>
                    <input type="text" name="food_name" class="form-control" value="<?= htmlspecialchars($menu['food_name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Allergen:</label>
                    <input type="text" name="allergen" class="form-control" value="<?= htmlspecialchars($menu['allergen']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description:</label>
                    <textarea name="description" class="form-control" required><?= htmlspecialchars($menu['description']) ?></textarea>
                </div>

                <button type="submit" class="btn btn-dark w-100">Update Menu Item</button>
            </form>
            
            <div class="text-center mt-3">
                <a href="admin_dashboard.php" class="btn btn-outline-secondary text-dark">
                    <i class="bi bi-arrow-return-left"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</body>
</html>
