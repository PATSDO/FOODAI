
<?php include 'db_connection.php'; ?> 
 

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
    <title>Add User - FAI</title>

    <link href="https://img.icons8.com/ios/50/null/food-bar.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
        body{
            background: url('img/adduserbg.png') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Add User</h2>
            <form method="POST" action="add_user.php">
                <div class="mb-3">
                    <label class="form-label">First Name:</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Last Name:</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Allergen:</label>
                    <input type="text" name="allergen" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role:</label>
                    <select name="role" class="form-select" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-dark w-100">Add User</button>
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
