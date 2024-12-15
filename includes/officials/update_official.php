<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id'])) {
    require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Official.php';
    $officialID = htmlspecialchars($_GET['id']);
    $officials = new Official();
    $officials = $officials->getOfficialID('official_table', $officialID);

    if (!$officials) {
        header("Location: http://localhost:3000/home.php?noresident");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formData = [];
        foreach ($_POST as $key => $value) {
            $formData[$key] = htmlspecialchars($value);
        }
        if (Database::getInstance()->update('official_table', $formData, $officialID, "official_id")) {
            header("Location: http://localhost:3000/officials.php");
            exit;
        } else {
            header("Location: http://localhost:3000/home.php?failed");
            exit;
        }
    }
} 
else {
    header("Location: http://localhost:3000/official.php?notID");
    exit;
} 