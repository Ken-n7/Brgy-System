<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Database.php';
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Official.php';

if (isset($_GET['id'] )) {
    $id = htmlspecialchars($_GET['id']);

    if (Database::getInstance()->remove('official_table', $id, 'official_id')) {
        header("Location: http://localhost:3000/officials.php"); 
        exit;
    } else {
        echo "Error deleting resident: ";
    }
} else {
    echo "No ID provided for deletion.";
}
