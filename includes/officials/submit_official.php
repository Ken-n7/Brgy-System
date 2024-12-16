<?php
session_start();  // Make sure the session is started
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Official.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepare the data from POST request
    $officialData = [];
    foreach ($_POST as $key => $value) {
        if (is_string($value)) {
            $value = ucwords($value);
        }
        $officialData[$key] = $value;
    }

    // Calculate the end date of the term
    $termStart = $officialData['office_start_date'];
    if (!empty($termStart)) {
        $startDate = new DateTime($termStart);
        $startDate->add(new DateInterval('P3Y'));
        $officialData['office_end_date'] = $startDate->format('Y-m-d');
    }

    $official = new Official();
    if ($official->addOfficial($officialData)) {
        $_SESSION['notification'] = ['type' => 'success', 'message' => 'Official added successfully.'];
        header("Location: http://localhost:3000/officials.php");
    } else {
        $_SESSION['notification'] = ['type' => 'error', 'message' => 'Error adding official.'];
        header("Location: http://localhost:3000/officials.php");
    }
}
?>

