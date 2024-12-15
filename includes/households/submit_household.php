<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Household.php'; 

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $householdData = [];
        foreach ($_POST as $key => $value) {
            $householdData[$key] = $value;
        }
        $household = new Household();
        $household->calculateHouseholdIncome();
            $household->calculateHouseholdSizes();
        if($household->addHousehold(householdData: $householdData)) {
            header("Location: http://localhost:3000/household.php"); //tagin notif con succesfull or dri
        }else{
        
            header("Location: http://localhost:3000/home.php");
        }
    }
