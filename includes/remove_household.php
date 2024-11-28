<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Database.php';

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    if (Database::getInstance()->remove('household_table', $id, 'HouseholdID')) {
        echo "Resident deleted successfully.";
        header("Location: http://localhost:3000/household.php"); 
        exit;
    } else {
        echo "Error deleting resident: ";
    }
} else {
    echo "No ID provided for deletion.";
}