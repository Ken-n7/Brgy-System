<?php
    require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Database.php';
    class Resident{

        private $connection;

        public function __construct(){
            $this->connection = Database::getInstance()->getDB_Connection();
        }

        public function addResident(array $residentData){
            $residentData['ResidentID'] = $this->generateResidentID();
            return Database::getInstance()->Add("resident_table", $residentData);
        }

        public function getResidents(){
            $stmt = $this->connection->prepare("SELECT 
                resident.*, 
                household.HouseholdName, 
                household.HouseholdNumber 
            FROM 
                resident_table resident
            LEFT JOIN 
                household_table household
            ON 
                resident.HouseholdID = household.HouseholdID");
            $stmt->execute();
            // $result =  $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            // print_r($result);
            // return $result;
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function getResidentID($table, $id){
            $stmt = mysqli_prepare($this->connection, "SELECT * FROM $table WHERE ResidentID = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $resident = $result->fetch_assoc();
            return $resident;
        }

        public function generateResidentID():int{
            do {
                $new_id = 640000 + random_int(1, 999);
            } while (!self::isUniqueID($new_id));
            
            return $new_id;
        }
    
        private static function isUniqueID(int $id): bool {
            $connection = Database::getInstance()->getDB_Connection();
            $stmt = $connection->prepare("SELECT COUNT(*) FROM resident_table WHERE ResidentID = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            return $count === 0;
        }
    }   