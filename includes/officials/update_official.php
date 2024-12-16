<?php
session_start();  // Make sure the session is started
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Official.php';

if (isset($_GET['id'])) {
    $officialID = htmlspecialchars($_GET['id']);
    $official = new Official();
    $officialData = $official->getOfficialID('official_table', $officialID);

    if (!$officialData) {
        header("Location: http://localhost:3000/home.php?noofficial");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formData = [];
        foreach ($_POST as $key => $value) {
            $formData[$key] = htmlspecialchars($value);
        }

        if (Database::getInstance()->update('official_table', $formData, $officialID, "official_id")) {
            $_SESSION['notification'] = ['type' => 'success', 'message' => 'Official updated successfully.'];
            header("Location: http://localhost:3000/officials.php");
        } else {
            $_SESSION['notification'] = ['type' => 'error', 'message' => 'Error updating official.'];
            header("Location: http://localhost:3000/officials.php");
        }
        exit;
    }
}
