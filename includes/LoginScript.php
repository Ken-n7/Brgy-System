<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $connection = Database::getInstance()->getDB_Connection();
    $username = $_POST['username'];
    $password = $_POST['password'];


    // if ($_POST['username'] == 'admin' && $_POST['password'] == 'password') {
    //     $_SESSION['logged_in'] = true;
    //     header('Location: dashboard.php'); // Redirect to the protected page
    //     exit();
    // } else {
    //     echo "Invalid credentials";
    // }


    $stmt = $connection->prepare("SELECT * FROM admin_credentials WHERE username = ? AND admin_password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['logged_in'] = true;
        header("Location: http://localhost:3000/home.php");
        exit();
    } else {
        header("Location: http://localhost:3000/login.php?error=1");
        exit();
    }

    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     $hashedPassword = $row['admin_password'];

    //     // Verify the input password with the hashed password
    //     if (password_verify($password, $hashedPassword)) {
    //         header("Location: http://localhost:3000/home.php");
    //         exit();
    //     } else {
    //         header("Location: http://localhost:3000/login.php?error=1");
    //         exit();
    //     }
    // } else {
    //     header("Location: http://localhost:3000/login.php?error=1");
    //     exit();
    // }
}


    
