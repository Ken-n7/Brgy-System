<?php
// Include your database connection file
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Database.php';

// Create a connection to the database
$connection = Database::getInstance()->getDB_Connection();

// Set the admin username and password
$username = 'admin';
$password = '123456789';  // The password provided

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement to insert the admin credentials
$stmt = $connection->prepare("INSERT INTO admin_credentials (username, admin_password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashedPassword);

// Execute the query
if ($stmt->execute()) {
    echo "Admin user inserted successfully!";
} else {
    echo "Error inserting admin: " . $stmt->error;
}

// Close the statement
$stmt->close();

// Close the connection
$connection->close();
?>
