<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id'])) {
    require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';
    $householdID = htmlspecialchars($_GET['id']);
    $households = new Household();
    $household = $households->getHouseholdID('household_table', $householdID);

    if (!$household) {
        header("Location: http://localhost:3000/home.php?noresident");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formData = [];
        foreach ($_POST as $key => $value) {
            $formData[$key] = htmlspecialchars($value);
        }
        if (Database::getInstance()->update('household_table', $formData, $householdID, "HouseholdID")) {
            header("Location: http://localhost:3000/household.php");
            exit;
        } else {
            header("Location: http://localhost:3000/home.php?failed");
            exit;
        }
    }
} 
else {
    header("Location: http://localhost:3000/household.php?notID");
    exit;
} 

