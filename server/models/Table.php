<?php
require_once(__DIR__ . '/../config/other-configs.php');

class Table
{
    public $dbObj;
    public $name;
    public $cols;
    public $extras;

    public function __construct($_name = null, $_cols = null, $_dbObj = null)
    {
        $this->name = $_name;
        $this->cols = $_cols;
        $this->dbObj = $_dbObj;
    }

    /* public function create()
    {
        return $this->dbObj->createTable($this->name, $this->cols, $this->extras);
    } */

    private function filterKeys($row) {
        $filteredRow = [];
        foreach($row as $key => $value)
        {
            if(in_array($key,$this->cols))
            {
                $filteredRow[$key] = $value;
            }
        }
        return $filteredRow;
    }
    
    public function insertRow($row)
    {
        $filteredRow = $this->filterKeys($row);
        return $this->dbObj->insertRow($this->name,$filteredRow);
    }

    public function find($colNames,$query)
    {
        return $this->dbObj->find($this->name,$colNames,$query);
    }

    public function findById($colNames,$_id)
    {
        $res =  $this->find($colNames,"`id` = {$_id}");
        if($res->num_rows > 0)
            return $res->fetch_assoc();
        return false;

    }

    protected function validateRow($row,$colNames = null)
    {
        if(array_key_exists('email',$row))
        {
            $row['email'] = filter_var($row['email'],FILTER_VALIDATE_EMAIL);
            if($row['email'] === false)
            {
                return false;
            }
        }
        if($colNames !== null)
        {
            foreach($colNames as $columnName)
            {
                if(empty($row[$columnName]) && !is_numeric($row[$columnName]))
                    return false;
            }
        }
        return true;
    }

    /* public function drop()
    {
        return $this->dbObj->drop($this->name);
    } */

    public function findAllExceptGivenCols($colNames,$query)
    {
        $colNamesForSQL = [];
        foreach($this->cols as $columnName)
        {
            if(! in_array($columnName,$colNames))
                $colNamesForSQL[] = $columnName;
        }
        return $this->find($colNamesForSQL,$query);
    }

}
