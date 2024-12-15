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

    // Use prepared statements to avoid SQL injection
    $stmt = $connection->prepare("SELECT * FROM admin_credentials WHERE username = ?");
    $stmt->bind_param("s", $username);  // Bind username parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashedPassword = $user['admin_password'];

        // Check if the input password matches the hashed password stored in the database
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username; // Optionally store the username or user id
            header("Location: http://localhost:3000/home.php");
            exit();
        } else {
            header("Location: http://localhost:3000/login.php?error=1");
            exit();
        }
    } else {
        header("Location: http://localhost:3000/login.php?error=1");
        exit();
    }
}
?>
