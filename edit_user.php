<?php
session_start();
require 'db_connection.php';

if (!isset($_GET['id'])) {
    die("User ID is required.");
}

$id = intval($_GET['id']);
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $allergen = mysqli_real_escape_string($conn, $_POST['allergen']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $update_query = "UPDATE users SET 
                        first_name='$first_name', 
                        last_name='$last_name', 
                        email='$email', 
                        allergen='$allergen', 
                        role='$role' 
                     WHERE id=$id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('User updated successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit User - FAI</title>

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
            background: url('img/edituserbg.png') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Edit User</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">First Name:</label>
                    <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($user['first_name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Last Name:</label>
                    <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($user['last_name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Allergen:</label>
                    <input type="text" name="allergen" class="form-control" value="<?= htmlspecialchars($user['allergen']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Role:</label>
                    <select name="role" class="form-select" required>
                        <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-dark w-100">Update User</button>
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
