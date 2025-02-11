<?php
$host = "localhost";
$username = "root";  // Change if needed
$password = "";      // Change if needed
$database = "food_ai_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
