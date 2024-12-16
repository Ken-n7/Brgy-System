<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session for notifications
session_start();

if (isset($_GET['id'])) {
    require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';

    // Sanitize the incoming household ID
    $householdID = htmlspecialchars($_GET['id']);

    // Instantiate Household class and fetch data
    $households = new Household();
    $household = $households->getHouseholdID('household_table', $householdID);

    // Redirect if household not found
    if (!$household) {
        $_SESSION['notification'] = [
            'type' => 'error',
            'message' => 'No such household found.'
        ];
        header("Location: http://localhost:3000/home.php?noresident");
        exit;
    }

    // Handle form submission for updating
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formData = [];
        foreach ($_POST as $key => $value) {
            $formData[$key] = htmlspecialchars($value);
        }

        // Perform update and handle feedback
        if (Database::getInstance()->update('household_table', $formData, $householdID, "Household_id")) {
            $_SESSION['notification'] = [
                'type' => 'success',
                'message' => 'Household information updated successfully.'
            ];
            header("Location: http://localhost:3000/household.php");
            exit;
        } else {
            $_SESSION['notification'] = [
                'type' => 'error',
                'message' => 'Failed to update household. Please try again.'
            ];
            header("Location: http://localhost:3000/home.php?failed");
            exit;
        }
    }
} else {
    $_SESSION['notification'] = [
        'type' => 'error',
        'message' => 'No household ID provided.'
    ];
    header("Location: http://localhost:3000/household.php?notID");
    exit;
}
