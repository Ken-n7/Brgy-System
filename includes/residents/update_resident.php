<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Resident.php';
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';

if (isset($_GET['id'])) {
    $residentID = htmlspecialchars($_GET['id']);
    $resident = new Resident();
    $resident = $resident->getResidentID('resident_table', $residentID);

    if (!$resident) {
        header("Location: http://localhost:3000/home.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formData = [];
        foreach ($_POST as $key => $value) {
            $formData[$key] = htmlspecialchars($value);
        }
        if (Database::getInstance()->update('resident_table', $formData, $residentID, "resident_id")) {
            $household = new Household();
            $household->calculateHouseholdIncome();
            $household->calculateHouseholdSizes();
            header("Location: http://localhost:3000/residents.php");
            exit;
        } else {
            header("Location: http://localhost:3000/home.php");
            exit;
        }
    }
} else {
    header("Location: http://localhost:3000/officials.php");
    exit;
}
?>