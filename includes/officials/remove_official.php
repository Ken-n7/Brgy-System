<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session for notifications
session_start();

require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Database.php';
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Official.php';

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    // Attempt to delete the official record
    if (Database::getInstance()->remove('official_table', $id, 'official_id')) {
        $_SESSION['notification'] = [
            'type' => 'success',
            'message' => 'Official record deleted successfully.'
        ];
        header("Location: http://localhost:3000/officials.php");
        exit;
    } else {
        // Notify if there is an error
        $_SESSION['notification'] = [
            'type' => 'error',
            'message' => 'Failed to delete official record. Please try again.'
        ];
        header("Location: http://localhost:3000/officials.php");
        exit;
    }
} else {
    // Notify if no ID is provided
    $_SESSION['notification'] = [
        'type' => 'error',
        'message' => 'No official ID provided for deletion.'
    ];
    header("Location: http://localhost:3000/officials.php");
    exit;
}
