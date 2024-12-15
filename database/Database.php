<?php
class Database{
    private $dbConnection;
    private static $instance;

    private function __construct()
    {
        $this->dbConnection = new mysqli("localhost", "root", "", "brgy_db");
        if ($this->dbConnection->connect_error) {
            die("Connection failed: " . $this->dbConnection->connect_error);
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getDB_Connection(): mysqli
    {
        return $this->dbConnection;
    }

    public function add(string $table, array $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $stmt = mysqli_prepare($this->dbConnection, "INSERT INTO $table ($columns) VALUES ($placeholders)");
        $parameterTypes = $this->checkParameterType($data);
        $values = array_values($data);
        $stmt->bind_param($parameterTypes, ...$values);
        return mysqli_stmt_execute($stmt);
    }

    public function remove(string $table, int $id, string $IDcolumn)
    {
        $stmt = mysqli_prepare($this->dbConnection, "DELETE FROM $table WHERE $IDcolumn = $id");
        return mysqli_stmt_execute($stmt);
    }

    public function update(string $table, array $data, int $id, string $IDcolumn){
        $columns = array_keys($data);
        $setClause = implode(" = ?, ", $columns) . " = ?";
        $stmt = mysqli_prepare($this->dbConnection, "UPDATE $table SET $setClause WHERE $IDcolumn = ?");
        $parameterTypes = $this->checkParameterType($data);
        $values = array_values($data);
        $values[] = $id;
        $parameterTypes .= 'i';
        $stmt->bind_param($parameterTypes, ...$values);
        return $stmt->execute(); 
    }

    private function checkParameterType(array $data)
    {
        $types = '';
        foreach ($data as $value) {
            if (is_numeric($value)) {
                if (strpos($value, '.') !== false) {
                    $types .= 'd';
                } else {
                    $types .= 'i';
                }
            } else {
                $types .= 's';
            }
        }
        return $types;
    }
}
