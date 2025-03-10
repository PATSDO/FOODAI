<?php
session_start();
require 'db_connection.php';

// Handle User Search Filters
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

$userWhereSQL = !empty($userWhereClauses) ? 'WHERE ' . implode(' AND ', $userWhereClauses) : '';

// Fetch Users with Filters
$usersQuery = "SELECT * FROM users $userWhereSQL";
$usersResult = mysqli_query($conn, $usersQuery);

// Handle Menu Filters
$menuWhereClauses = [];
if (!empty($_GET['restaurant'])) {
    $restaurant = mysqli_real_escape_string($conn, $_GET['restaurant']);
    $menuWhereClauses[] = "restaurant_name = '$restaurant'";
}

if (!empty($_GET['allergen'])) {
    $allergen = mysqli_real_escape_string($conn, $_GET['allergen']);
    $menuWhereClauses[] = "allergen = '$allergen'";
}

$menuWhereSQL = !empty($menuWhereClauses) ? 'WHERE ' . implode(' AND ', $menuWhereClauses) : '';

// Fetch Menu Items with Filters
$menuQuery = "SELECT * FROM menu $menuWhereSQL";
$menuResult = mysqli_query($conn, $menuQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <!-- Admin -->
    <title>Admin Dashboard - FAI</title>

    <link href="https://img.icons8.com/ios/50/null/food-bar.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid px-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-4 text-center bg-secondary py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-envelope fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 style="font-family: Times New Roman" class="text-uppercase mb-1">Email Us</h6>
                        <span>foodai@gmail.com</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center bg-primary border-inner py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <a href="index.php" class="navbar-brand">
                        <h1 style="font-family: Times New Roman" class="m-0 text-uppercase text-white">Food AI</h1>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center bg-secondary py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <div class="text-start">
                        <?php if (isset($_SESSION['first_name'])): ?>
                            <h6 class="text-black">Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</h6>
                            <a href="logout.php"><button style="font-family: Times New Roman" type="button" class="btn btn-danger btn-lg">Logout</button></a>
                        <?php else: ?>
                            <a href="register.php"><button style="font-family: Times New Roman" type="button" class="btn btn-primary btn-lg">Register</button></a>
                            <a href="login.php"><button style="font-family: Times New Roman" type="button" class="btn btn-primary btn-lg">Login</button></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <h2>Admin Dashboard</h2>

    <!-- Manage Users -->
    <h3>Manage Users</h3>

    <!-- Add User -->
    <a href="add_user.php">Add User</a>

    <!-- User Filter -->
    <form method="GET" action="admin_dashboard.php">
        <label for="search_user">Search Name:</label>
        <input type="text" name="search_user" placeholder="Enter first or last name" value="<?= $_GET['search_user'] ?? '' ?>">

        <label for="user_allergen">Filter by Allergen:</label>
        <select name="user_allergen">
            <option value="">All</option>
            <?php
            $allergenQuery = "SELECT DISTINCT allergen FROM users WHERE allergen IS NOT NULL";
            $allergenResult = mysqli_query($conn, $allergenQuery);
            while ($row = mysqli_fetch_assoc($allergenResult)) {
                $selected = ($_GET['user_allergen'] ?? '') == $row['allergen'] ? 'selected' : '';
                echo "<option value='{$row['allergen']}' $selected>{$row['allergen']}</option>";
            }
            ?>
        </select>

        <label for="user_role">Filter by Role:</label>
        <select name="user_role">
            <option value="">All</option>
            <option value="admin" <?= ($_GET['user_role'] ?? '') == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="user" <?= ($_GET['user_role'] ?? '') == 'user' ? 'selected' : '' ?>>User</option>
        </select>

        <button type="submit">Filter</button>
    </form>

    <!-- users Table -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Allergen</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php while ($user = mysqli_fetch_assoc($usersResult)): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['first_name'] ?></td>
                <td><?= $user['last_name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['allergen'] ?: 'None' ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <a href="edit_user.php?id=<?= $user['id'] ?>">Edit</a> | 
                    <a href="delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- Manage Menu -->
    <h3>Manage Menu</h3>

    <!-- Add Menu -->
    <a href="add_menu.php">Add Menu Item</a>

    <!-- Menu Filter -->
    <form method="GET" action="admin_dashboard.php">
        <label for="restaurant">Filter by Restaurant:</label>
        <select name="restaurant">
            <option value="">All</option>
            <?php
            $restaurantQuery = "SELECT DISTINCT restaurant_name FROM menu";
            $restaurantResult = mysqli_query($conn, $restaurantQuery);
            while ($row = mysqli_fetch_assoc($restaurantResult)) {
                $selected = ($_GET['restaurant'] ?? '') == $row['restaurant_name'] ? 'selected' : '';
                echo "<option value='{$row['restaurant_name']}' $selected>{$row['restaurant_name']}</option>";
            }
            ?>
        </select>

        <label for="allergen">Filter by Allergen:</label>
        <select name="allergen">
            <option value="">All</option>
            <?php
            $allergenQuery = "SELECT DISTINCT allergen FROM menu";
            $allergenResult = mysqli_query($conn, $allergenQuery);
            while ($row = mysqli_fetch_assoc($allergenResult)) {
                $selected = ($_GET['allergen'] ?? '') == $row['allergen'] ? 'selected' : '';
                echo "<option value='{$row['allergen']}' $selected>{$row['allergen']}</option>";
            }
            ?>
        </select>

        <button type="submit">Filter</button>
    </form>

    <!-- Menu Table -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Restaurant</th>
            <th>Food</th>
            <th>Allergen</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php while ($menu = mysqli_fetch_assoc($menuResult)): ?>
            <tr>
                <td><?= $menu['id'] ?></td>
                <td><?= $menu['restaurant_name'] ?></td>
                <td><?= $menu['food_name'] ?></td>
                <td><?= $menu['allergen'] ?></td>
                <td><?= $menu['description'] ?></td>
                <td>
                    <a href="edit_menu.php?id=<?= $menu['id'] ?>">Edit</a> | 
                    <a href="delete_menu.php?id=<?= $menu['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
