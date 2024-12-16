<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Resident.php';
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $residentData = [];
    
    foreach ($_POST as $key => $value) {
        if (is_string($value)) {
            $value = ucwords($value); 
        }

        $residentData[$key] = $value;
    }

    $resident = new Resident();
    if ($resident->addResident(residentData: $residentData)) {
        $household = new Household();
        $household->calculateHouseholdIncome();
        $household->calculateHouseholdSizes();
        $_SESSION['notification'] = [
            'type' => 'success',
            'message' => 'Resident added successfully.'
        ];

        header("Location: http://localhost:3000/residents.php");
        exit;
    } else {
        $_SESSION['notification'] = [
            'type' => 'error',
            'message' => 'Failed to add resident. Please try again.'
        ];

        header("Location: http://localhost:3000/residents.php");
        exit;
    }
}

