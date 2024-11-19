<?php

require(__DIR__ . '/../Config/init.php');

class Category extends Model
{
    private $database;

    /**
     * Constructor that calls the parent constructor and sets the table name for this class.
     * $this->tableName is refers to the table name in the database which will be used by this model.
     * $this->setTableName is a method from the parent class that sets the table name.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('categories');

        $this->database = new Database();
    }

    /**
     * Method  to get all products from the database and return the result as an associative array.
     */
    public function getCategories(array $columns = ['*'], array $joins = [], array $conditions = [], int $limit = 0)
    {
        // call database selectData
        // return fetched data
        return $this->database->selectData($this->tableName, $columns, $joins, $conditions, $limit);
    }

    public function createCategory($data)
    {
        // construct data as array association
        // call database insertData and pass the constructed data
        // return boolean

        return $this->database->insertData($this->tableName, $data);
    }

    public function updateCategory($id, $data)
    {
        // call updateData
        //return boolean
        return $this->database->updateData($this->tableName, $id, $data);
    }

    public function deleteCategory($id)
    {
        // call deteleRecord
        return $this->database->deleteRecord($this->tableName, $id);
    }

    public function restoreProduct()
    {
        // call restoreRecord
        return $this->database->restoreRecord($this->tableName);
    }
}
