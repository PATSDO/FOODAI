<?php
require 'db_connection.php';

// Admin credentials
$first_name = 'Admin';
$last_name = 'User';
$email = 'admin@gmail.com';
$password = 'admin';
$role = 'admin';

// Hash the password
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Check if admin already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>alert('Admin user already exists!');</script>";
} else {
    // Insert the admin user
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password_hash, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $password_hash, $role);

    if ($stmt->execute()) {
        echo "<script>alert('Admin user created successfully!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}

$stmt->close();
$conn->close();
?>

<!-- Admin Info -->

Email: admin@gmail.com
<br>
Password: admin

