<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Resident.php';
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Official.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepare the data from POST request
    $officialData = [];
    foreach ($_POST as $key => $value) {
        if (is_string($value)) {
            // Format the values, e.g., capitalize the names or positions
            $value = ucwords($value);
        }
        // Collect the POST data into an array
        $officialData[$key] = $value;
    }

    // Get the term start date from POST data
    $termStart = $officialData['office_start_date'];

    // Calculate the term end date by adding 3 years to the start term
    if (!empty($termStart)) {
        $startDate = new DateTime($termStart);
        $startDate->add(new DateInterval('P3Y'));  // Add 3 years to the start date
        $officialData['office_end_date'] = $startDate->format('Y-m-d'); // Set the end date in the format YYYY-MM-DD
    }

    // Instantiate the Official class
    $official = new Official();

    // Add the official to the official table
    if ($official->addOfficial($officialData)) {
        // If successful, redirect to the officials list page
        header("Location: http://localhost:3000/officials.php");
    } else {
        // If there's an issue, redirect to a fallback page or show an error
        header("Location: http://localhost:3000/home.php");
    }
}
?>


