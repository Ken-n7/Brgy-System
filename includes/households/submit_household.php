<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';
session_start(); // Start session for notifications

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $householdData = [];
    
    // Collect form data
    foreach ($_POST as $key => $value) {
        $householdData[$key] = $value;
    }
    
    $household = new Household();
    $household->calculateHouseholdIncome();
    $household->calculateHouseholdSizes();
    
    // Attempt to add the household
    if ($household->addHousehold(householdData: $householdData)) {
        // Set a success notification
        $_SESSION['notification'] = [
            'type' => 'success',
            'message' => 'Household added successfully.'
        ];
        header("Location: http://localhost:3000/household.php");
    } else {
        // Set an error notification
        $_SESSION['notification'] = [
            'type' => 'error',
            'message' => 'Failed to add household. Please try again.'
        ];
        header("Location: http://localhost:3000/household.php");
    }
    exit; // Always exit after a header redirect
}
