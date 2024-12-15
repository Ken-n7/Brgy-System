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
            $householdData['Household_id'] = $this->generateHouseholdID();
            return Database::getInstance()->add("household_table", $householdData);
        }

        public function getHouseholdID($table, $id){
            $stmt = mysqli_prepare($this->connection, "SELECT * FROM $table WHERE household_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $household = $result->fetch_assoc();
            return $household;
        }

        public function calculateHouseholdSizes() {
            $stmt = $this->connection->prepare("UPDATE 
                household_table h
                SET household_size = (
                    SELECT COUNT(*) 
                    FROM resident_table r 
                    WHERE r.household_id = h.household_id
                )
            ");
            $stmt->execute();
        }

        public function calculateHouseholdIncome(){
            $stmt = $this->connection->prepare("UPDATE 
                household_table h
                SET household_income = (
                    SELECT SUM(Income) 
                    FROM resident_table r 
                    WHERE r.household_id = h.household_id
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
            $count = null;
            $connection = Database::getInstance()->getDB_Connection();
            $stmt = $connection->prepare("SELECT COUNT(*) FROM resident_table WHERE Household_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            return $count === 0;
        }

    }