<?php
$servername = "localhost";  // Change if using a remote server
$username = "root";  // Update based on your DB credentials
$password = "";  // Update if you set a password
$database = "food_ai_db";  

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
