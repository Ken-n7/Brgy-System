<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Resident.php';
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';

session_start();

if (isset($_GET['id'])) {
    $residentID = htmlspecialchars($_GET['id']);

    $residentObj = new Resident();
    $resident = $residentObj->getResidentID('resident_table', $residentID);

    if (!$resident) {
        header("Location: http://localhost:3000/residents.php");
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
            $_SESSION['notification'] = [
                'type' => 'success',
                'message' => 'Resident updated successfully.'
            ];
            header("Location: http://localhost:3000/residents.php");
            exit;
        } else {
            $_SESSION['notification'] = [
                'type' => 'error',
                'message' => 'Failed to update resident. Please try again.'
            ];
            header("Location: http://localhost:3000/residents.php");
            exit;
        }
    }
} else {
    header("Location: http://localhost:3000/residents.php");
    exit;
}
?>
