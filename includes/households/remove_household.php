<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Database.php';
session_start(); // Start session for notifications

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    // Validate ID format (assumes it's numeric; adjust if otherwise)
    if (!is_numeric($id)) {
        $_SESSION['notification'] = [
            'type' => 'error',
            'message' => 'Invalid ID format.'
        ];
        header("Location: http://localhost:3000/household.php");
        exit;
    }

    // Perform deletion
    if (Database::getInstance()->remove('household_table', $id, 'Household_id')) {
        $_SESSION['notification'] = [
            'type' => 'success',
            'message' => 'Household deleted successfully.'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'error',
            'message' => 'Error deleting household. Please try again.'
        ];
    }
} else {
    $_SESSION['notification'] = [
        'type' => 'error',
        'message' => 'No ID provided for deletion.'
    ];
}

// Redirect to the household page
header("Location: http://localhost:3000/household.php");
exit;
