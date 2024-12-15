<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Resident.php';
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $residentData = [];
    foreach ($_POST as $key => $value) {
        print_r(ucwords($value));
        if(is_string($value)){
            print_r($value);
            $value = ucwords($value);
            print_r($value);
        }
        $residentData[$key] = $value;
    }
    $resident = new Resident();
    if ($resident->addResident(residentData: $residentData)) {
        $household = new Household();
        $household->calculateHouseholdIncome();
        $household->calculateHouseholdSizes();
        header("Location: http://localhost:3000/residents.php"); //tagin notif con succesfull or dri
    } else {

        header("Location: http://localhost:3000/home.php");
    }
}
