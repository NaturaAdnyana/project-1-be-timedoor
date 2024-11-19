<?php
require(__DIR__ . '/../Config/init.php');

class Database
{
    private $host;
    private $database;
    private $username;
    private $password;
    private $conn;

    public function __construct()
    {
        $this->host = DB_SERVER;
        $this->database = DB_DATABASE;
        $this->username = DB_USERNAME;
        $this->password = DB_PASSWORD;
    }

    public function getInstance()
    {
        $db = "mysql:host={$this->host};dbname={$this->database}";

        if (!isset($this->conn)) {
            $this->conn = new PDO($db, $this->username, $this->password);
        }
        return $this->conn;
    }

    private function bindParams($stmt, $params)
    {
        foreach ($params as $key => &$value) {
            $stmt->bindParam(":" . $key, $value);
        }
    }

    /**
     * Method  to perform a select query with filter parameters.
     * it will take all the data in the table  but filtered by the given conditions if the id is not empty
     * it  will only show the row that has the same id as the one provided 
     * @param string $tableName : The name of the table in which we are searching
     * @param int $id           : The unique identifier of the record we want to retrieve
     * @param int isDeleted     : the deleted status of the record
     */
    public function selectData($tableName, array $columns = ['*'], array $joins = [], array $wheres = [], int $limit = 0)
    {
        $formatedCollumns = implode(", ", $columns);
        $query = "SELECT {$formatedCollumns} FROM {$tableName}";

        if (count($joins) > 0) {
            foreach ($joins as $table => $condition) {
                $query .= " INNER JOIN $table ON $condition";
            }
        }

        $conditions = [];
        $placeholders = [];
        if (count($wheres) > 0) {
            $conditions = [];
            foreach ($wheres as $key => $value) {
                $placeholder = str_replace('.', '_', $key);
                $conditions[] = "$key = :$placeholder";
                $placeholders[$placeholder] = $value;
            }
            $query .= " WHERE " . implode(" AND ", $conditions);
        }


        if ($limit > 0) {
            $query .= " LIMIT $limit";
        }

        $result = $this->getInstance()->prepare($query);
        foreach ($placeholders as $placeholder => $value) {
            $result->bindParam(":$placeholder", $value);
        }
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Method to add  data into the database. It takes an array of key-value pairs where keys are column names and
     * @param string $tableName the name of the table to insert into.
     * @param array $fillable an associative array containing column names and values.
     */
    public function insertData($tableName, $fillable)
    {
        try {
            $keys = implode(', ', array_keys($fillable));
            $values = ':' . implode(', :', array_keys($fillable));
            $query = "INSERT INTO {$tableName} ({$keys}) VALUES ({$values})";
            var_dump($query);
            $stmt = $this->getInstance()->prepare($query);
            $stmt->execute($fillable);
            return true;
        } catch (PDOException $e) {
            return false; // Return false on failure
        }
    }

    /**
     * Method to update the data  of an existing record.
     * @param string $tableName  : The name of the table where we want to insert into.
     * @param array $data        : An associative array containing the column names and values for updating.
     * @param int $id            : Name of the unique identifier column.
     */
    public function updateData($tableName, $id, $data)
    {
        try {
            $clause = '';
            foreach ($data as $key => $value) {
                $clause .= "$key = :$key, ";
            }
            $clause = rtrim($clause, ', ');
            $query = "UPDATE {$tableName} SET {$clause} WHERE id = {$id}";
            $stmt  = $this->getInstance()->prepare($query);
            $this->bindParams($stmt, $data);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return ("Error updating data: " . $e->getMessage());
        }
    }

    /**
     * Method to destroy  a specific record from the database by  setting its `isDeleted` field to 1.
     * @param string $tableName : The name of the table.
     * @param int $id           : The primary key value of the row that needs deleting
     */
    public function deleteRecord($tableName, $id)
    {
        $query = "UPDATE {$tableName} SET isDeleted=1 WHERE id={$id}";
        $stmt = $this->getInstance()->prepare($query);
        $stmt->execute();
    }

    /**
     * Method to restore  a soft-deleted record in the database by setting its `isDeleted` field to  0.
     * @param string $tableName : The name of the table.
     */
    public function restoreRecord($tableName)
    {
        $query = "UPDATE {$tableName} SET isDeleted=0 WHERE isDeleted=1";
        $stmt  = $this->getInstance()->prepare($query);
        $stmt->execute();
    }
}
