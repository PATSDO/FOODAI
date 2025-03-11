<?php
session_start();
require 'db_connection.php';

// User filtering logic
$userWhereClauses = [];
if (!empty($_GET['search_user'])) {
    $searchUser = mysqli_real_escape_string($conn, $_GET['search_user']);
    $userWhereClauses[] = "(first_name LIKE '%$searchUser%' OR last_name LIKE '%$searchUser%')";
}

if (!empty($_GET['user_allergen'])) {
    $userAllergen = mysqli_real_escape_string($conn, $_GET['user_allergen']);
    $userWhereClauses[] = "allergen = '$userAllergen'";
}

if (!empty($_GET['user_role'])) {
    $userRole = mysqli_real_escape_string($conn, $_GET['user_role']);
    $userWhereClauses[] = "role = '$userRole'";
}

// Menu filtering logic
$menuWhereClauses = [];
if (!empty($_GET['restaurant'])) {
    $restaurant = mysqli_real_escape_string($conn, $_GET['restaurant']);
    $menuWhereClauses[] = "restaurant_name = '$restaurant'";
}

if (!empty($_GET['allergen'])) {
    $allergen = mysqli_real_escape_string($conn, $_GET['allergen']);
    $menuWhereClauses[] = "allergen = '$allergen'";
}

// Prepare and execute queries
$userWhereSQL = !empty($userWhereClauses) ? 'WHERE ' . implode(' AND ', $userWhereClauses) : '';
$menuWhereSQL = !empty($menuWhereClauses) ? 'WHERE ' . implode(' AND ', $menuWhereClauses) : '';

$usersQuery = "SELECT * FROM users $userWhereSQL";
$usersResult = mysqli_query($conn, $usersQuery);

$menuQuery = "SELECT * FROM menu $menuWhereSQL";
$menuResult = mysqli_query($conn, $menuQuery);

// Get filter options
$allergenQuery = "SELECT DISTINCT allergen FROM users WHERE allergen IS NOT NULL";
$allergenResult = mysqli_query($conn, $allergenQuery);

$restaurantQuery = "SELECT DISTINCT restaurant_name FROM menu";
$restaurantResult = mysqli_query($conn, $restaurantQuery);

$menuAllergenQuery = "SELECT DISTINCT allergen FROM menu";
$menuAllergenResult = mysqli_query($conn, $menuAllergenQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Food AI</title>
    
    <!-- External CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            background: url('img/addashbg.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #000;
        }
        
        .container-wrapper {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
            border-radius: 5px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }
        
        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }
        
        .section-header {
            border-bottom: 1px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        
        .navbar-custom {
            background-color: #000;
        }
        
        .btn-custom {
            background-color: #000;
            color: #fff;
            border: 1px solid #000;
        }
        
        .btn-custom:hover {
            background-color: #333;
            color: #fff;
        }
        
        .btn-danger-custom {
            background-color: #fff;
            color: #000;
            border: 1px solid #000;
        }
        
        .btn-danger-custom:hover {
            background-color: #eee;
            color: #000;
        }
        
        table {
            background-color: #fff;
            border: 1px solid #000;
        }
        
        thead {
            background-color: #000;
            color: #fff;
        }
        
        .action-link {
            color: #000;
            text-decoration: none;
            margin-right: 10px;
        }
        
        .action-link:hover {
            text-decoration: underline;
        }
        
        .form-control, .form-select {
            border: 1px solid #000;
            font-family: "Times New Roman", Times, serif;
        }
        
        .topbar {
            background-color: #000;
            color: #fff;
            padding: 15px 0;
        }
        
        .brand-section {
            border-left: 1px solid #fff;
            border-right: 1px solid #fff;
        }
        
        .welcome-message {
            display: inline-block;
            margin-right: 15px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <!-- Top Navigation Bar -->
    <div class="topbar">
        <div class="container">
            <div class="row align-items-center">
                <!-- Email Section -->
                <div class="col-md-4 text-center text-md-start">
                    <i class="fas fa-envelope me-2"></i>
                    <span>foodai@gmail.com</span>
                </div>
                
                <!-- Brand Logo Section -->
                <div class="col-md-4 text-center brand-section">
                    <a href="index.php" class="text-decoration-none">
                        <h1 class="m-0 text-uppercase text-white">Food AI</h1>
                    </a>
                </div>
                
                <!-- User Controls Section -->
                <div class="col-md-4 text-center text-md-end">
                    <?php if (isset($_SESSION['first_name'])): ?>
                        <div class="welcome-message">
                            Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!
                        </div>
                        <a href="logout.php" class="btn btn-danger-custom">Logout</a>
                    <?php else: ?>
                        <a href="register.php" class="btn btn-custom me-2">Register</a>
                        <a href="login.php" class="btn btn-custom">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content Area -->
    <div class="container container-wrapper">
        <div class="dashboard-header">
            <h2>Admin Dashboard</h2>
        </div>
        
        <!-- Users Management Section -->
        <div class="mb-5">
            <h3 class="section-header">Manage Users</h3>
            
            <!-- Add User Button -->
            <div class="mb-3">
                <a href="add_user.php" class="btn btn-custom mb-3">
                    <i class="fas fa-user-plus me-2"></i>Add User
                </a>
            </div>
            
            <!-- User Filter Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="admin_dashboard.php">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="search_user" class="form-label">Search Name:</label>
                                <input type="text" class="form-control" name="search_user" 
                                       placeholder="Enter first or last name" 
                                       value="<?= htmlspecialchars($_GET['search_user'] ?? '') ?>">
                            </div>
                            
                            <div class="col-md-3">
                                <label for="user_allergen" class="form-label">Filter by Allergen:</label>
                                <select class="form-select" name="user_allergen">
                                    <option value="">All</option>
                                    <?php while ($row = mysqli_fetch_assoc($allergenResult)): ?>
                                        <?php $selected = ($_GET['user_allergen'] ?? '') == $row['allergen'] ? 'selected' : ''; ?>
                                        <option value="<?= htmlspecialchars($row['allergen']) ?>" <?= $selected ?>>
                                            <?= htmlspecialchars($row['allergen']) ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="user_role" class="form-label">Filter by Role:</label>
                                <select class="form-select" name="user_role">
                                    <option value="">All</option>
                                    <option value="admin" <?= ($_GET['user_role'] ?? '') == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="user" <?= ($_GET['user_role'] ?? '') == 'user' ? 'selected' : '' ?>>User</option>
                                </select>
                            </div>
                            
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-custom w-100">
                                    <i class="fas fa-filter me-2"></i>Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Users Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Allergen</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($usersResult) > 0): ?>
                            <?php while ($user = mysqli_fetch_assoc($usersResult)): ?>
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td><?= htmlspecialchars($user['first_name']) ?></td>
                                    <td><?= htmlspecialchars($user['last_name']) ?></td>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td><?= htmlspecialchars($user['allergen'] ?: 'None') ?></td>
                                    <td><?= htmlspecialchars($user['role']) ?></td>
                                    <td>
                                        <a href="edit_user.php?id=<?= $user['id'] ?>" class="action-link">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="delete_user.php?id=<?= $user['id'] ?>" 
                                           class="action-link text-danger"
                                           onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No users found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Menu Management Section -->
        <div class="mb-5">
            <h3 class="section-header">Manage Menu</h3>
            
            <!-- Add Menu Button -->
            <div class="mb-3">
                <a href="add_menu.php" class="btn btn-custom mb-3">
                    <i class="fas fa-utensils me-2"></i>Add Menu Item
                </a>
            </div>
            
            <!-- Menu Filter Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="admin_dashboard.php">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label for="restaurant" class="form-label">Filter by Restaurant:</label>
                                <select class="form-select" name="restaurant">
                                    <option value="">All</option>
                                    <?php mysqli_data_seek($restaurantResult, 0); ?>
                                    <?php while ($row = mysqli_fetch_assoc($restaurantResult)): ?>
                                        <?php $selected = ($_GET['restaurant'] ?? '') == $row['restaurant_name'] ? 'selected' : ''; ?>
                                        <option value="<?= htmlspecialchars($row['restaurant_name']) ?>" <?= $selected ?>>
                                            <?= htmlspecialchars($row['restaurant_name']) ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            
                            <div class="col-md-5">
                                <label for="allergen" class="form-label">Filter by Allergen:</label>
                                <select class="form-select" name="allergen">
                                    <option value="">All</option>
                                    <?php while ($row = mysqli_fetch_assoc($menuAllergenResult)): ?>
                                        <?php $selected = ($_GET['allergen'] ?? '') == $row['allergen'] ? 'selected' : ''; ?>
                                        <option value="<?= htmlspecialchars($row['allergen']) ?>" <?= $selected ?>>
                                            <?= htmlspecialchars($row['allergen']) ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-custom w-100">
                                    <i class="fas fa-filter me-2"></i>Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Menu Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Restaurant</th>
                            <th>Food</th>
                            <th>Allergen</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($menuResult) > 0): ?>
                            <?php while ($menu = mysqli_fetch_assoc($menuResult)): ?>
                                <tr>
                                    <td><?= $menu['id'] ?></td>
                                    <td><?= htmlspecialchars($menu['restaurant_name']) ?></td>
                                    <td><?= htmlspecialchars($menu['food_name']) ?></td>
                                    <td><?= htmlspecialchars($menu['allergen']) ?></td>
                                    <td><?= htmlspecialchars($menu['description']) ?></td>
                                    <td>
                                        <a href="edit_menu.php?id=<?= $menu['id'] ?>" class="action-link">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="delete_menu.php?id=<?= $menu['id'] ?>" 
                                           class="action-link text-danger"
                                           onclick="return confirm('Are you sure you want to delete this menu item?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No menu items found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; <?= date('Y') ?> Food AI Admin Dashboard. All rights reserved.</p>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
