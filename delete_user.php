<?php
session_start();
require 'db_connection.php';

if (!isset($_GET['id'])) {
    die("User ID is required.");
}

$id = intval($_GET['id']);

// Prevent deleting the last admin
$check_admin_query = "SELECT COUNT(*) AS admin_count FROM users WHERE role = 'admin'";
$admin_result = mysqli_query($conn, $check_admin_query);
$admin_count = mysqli_fetch_assoc($admin_result)['admin_count'];

$query = "SELECT role FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}

if ($user['role'] === 'admin' && $admin_count <= 1) {
    die("Cannot delete the last admin.");
}

$delete_query = "DELETE FROM users WHERE id = $id";

if (mysqli_query($conn, $delete_query)) {
    echo "<script>alert('User deleted successfully!'); window.location='admin_dashboard.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>

<!-- Delete Users -->
