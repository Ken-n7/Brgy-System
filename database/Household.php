<?php
    require_once 'C:\xampp\htdocs\BRGY SYSTEM\database\Database.php';
    class Household{
        private $connection;

        public function __construct(){
            $this->connection = Database::getInstance()->getDB_Connection();
        }

        public function getHouseholds(){
            $stmt = $this->connection->prepare("SELECT * FROM `household_table`");
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        public function addHousehold($householdData){
            $householdData['HouseholdID'] = $this->generateHouseholdID();
            return Database::getInstance()->add("household_table", $householdData);
        }

        public function getHouseholdID($table, $id){
            $stmt = mysqli_prepare($this->connection, "SELECT * FROM $table WHERE HouseholdID = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $household = $result->fetch_assoc();
            return $household;
        }

        public function calculateHouseholdSizes() {
            $stmt = $this->connection->prepare("UPDATE 
                household_table h
                SET Household_Size = (
                    SELECT COUNT(*) 
                    FROM resident_table r 
                    WHERE r.HouseholdID = h.HouseholdID
                )
            ");
            $stmt->execute();
        }

        public function calculateHouseholdIncome(){
            $stmt = $this->connection->prepare("UPDATE 
                household_table h
                SET Household_Income = (
                    SELECT SUM(Income) 
                    FROM resident_table r 
                    WHERE r.HouseholdID = h.HouseholdID
                )
            ");
            $stmt->execute();
        }
        
        
        public static function generateHouseholdID():int{
            do {
                $new_id = random_int(1, 999);
            } while (!self::isUniqueID($new_id));
            
            return $new_id;
        }
    
        private static function isUniqueID(int $id): bool {
            $connection = Database::getInstance()->getDB_Connection();
            $stmt = $connection->prepare("SELECT COUNT(*) FROM resident_table WHERE HouseholdID = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            return $count === 0;
        }

    }