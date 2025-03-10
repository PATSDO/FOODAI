<?php
session_start();
require 'db_connection.php';

if (!isset($_GET['id'])) {
    die("Menu ID is required.");
}

$id = intval($_GET['id']);
$delete_query = "DELETE FROM menu WHERE id = $id";

if (mysqli_query($conn, $delete_query)) {
    echo "<script>alert('Menu item deleted successfully!'); window.location='admin_dashboard.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
