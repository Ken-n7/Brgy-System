<?php
require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Database.php';

class Official
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getDB_Connection();
    }

    // Method to add an official
    public function addOfficial(array $officialData)
    {
        $officialData['official_id'] = $this->generateOfficialID();
        return Database::getInstance()->Add("official_table", $officialData);
    }

    // Method to get all officials, joining with resident data
    public function getOfficials()
    {
        $stmt = $this->connection->prepare("SELECT 
            official.official_id, 
            resident.first_name, 
            resident.last_name, 
            resident.middle_name, 
            resident.age, 
            resident.gender, 
            official.position, 
            official.office_start_date, 
            official.office_end_date
        FROM 
            official_table official
        LEFT JOIN 
            resident_table resident
        ON 
            official.resident_id = resident.resident_id");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Method to get an official by ID
    public function getOfficialID($table, $id)
    {
        $stmt = mysqli_prepare($this->connection, "SELECT * FROM $table WHERE official_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $official = $result->fetch_assoc();
        return $official;
    }

    // Generate a unique ID for an official
    public function generateOfficialID(): int
    {
        do {
            $new_id = 500000 + random_int(1, 999);  // Start from 500000 for officials
        } while (!self::isUniqueOfficialID($new_id));

        return $new_id;
    }

    // Check if the official ID is unique
    private static function isUniqueOfficialID(int $id): bool
    {
        $connection = Database::getInstance()->getDB_Connection();
        $stmt = $connection->prepare("SELECT COUNT(*) FROM official_table WHERE official_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count === 0;
    }

    public function checkIfOfficial($resident_id)
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) FROM official_table WHERE resident_id = ?");
        $stmt->bind_param("i", $resident_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        if($count > 0) return true;
        return false;
    }
}
