<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Database.php';
$connection = Database::getInstance()->getDB_Connection();
$stmt = $connection->prepare("SELECT * FROM `household_table`");
$stmt->execute();
$households = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// if (!empty($residents)) {
//     $columns = array_keys($residents[0]);
// } else {
//     $columns = [];
// }