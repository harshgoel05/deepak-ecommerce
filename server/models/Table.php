<?php
namespace Models;

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../config/other-configs.php');

abstract class Table
{
    public $dbObj;
    public $name;
    public $cols;
    public $extras;

    public function __construct($_name = null, $_dbObj = null)
    {
        $this->name = $_name;
        $this->dbObj = $_dbObj;
        $this->cols = $this->getCols();
    }

    /* public function create()
    {
        return $this->dbObj->createTable($this->name, $this->cols, $this->extras);
    } */

    protected static $instances = [];
    
    public static function getInstance() 
    {
        $className = static::class;
        if(!isset(self::$instances[$className]))
        {
            self::$instances[$className] = new static();
        }
        return self::$instances[$className]; 
    }
    
    private function filterKeys($row) {
        $filteredRow = [];
        // print_r($this->cols);
        // echo '<br>';
        foreach($row as $key => $value)
        {
            if(in_array($key,$this->cols,true))
            {
                // print_r($key);
                // echo '<br>';
                $filteredRow[$key] = $value;
            }
        }
        return $filteredRow;
    }
    
    public function insertRow($row,$extra=null)
    {
        $filteredRow = $this->filterKeys($row);
        return $this->dbObj->insertRow($this->name,$filteredRow,$extra);

    }

    public function find($colNames=null,$query=null)
    {
        return $this->dbObj->find($this->name,$colNames,$query);
    }

    public function findById($colNames,$_id)
    {
        $res =  $this->find($colNames,"`id` = {$_id}");
        if($res->num_rows > 0)
            return $res->fetch_assoc();
        return null;

    }

    protected function validateRow($row,$colNames = null)
    {
        if($colNames !== null)
        {
            foreach($colNames as $columnName)
            {
                if(empty($row[$columnName]) && !is_numeric($row[$columnName]))
                {
                    return new Fallacy(CustomErrors::TYPE_ERROR,CustomErrors::valueNotFoundMessage($columnName));
                }
            }
        }
        return true;
    }

    /* public function drop()
    {
        return $this->dbObj->drop($this->name);
    } */

    public function findAllExceptGivenCols($colNames,$query=null)
    {
        $colNamesForSQL = [];
        foreach($this->cols as $columnName)
        {
            if(! in_array($columnName,$colNames))
                $colNamesForSQL[] = $columnName;
        }
        $temp_res = $this->find($colNamesForSQL,$query);
        // print_r($temp_res->fetch_assoc());
        return $temp_res;
    }

    public function getCols()
    {
        $queryRes = $this->dbObj->describe($this->name,MYSQLI_ASSOC);
        $_cols = [];
        if($queryRes !== null)
        {
            foreach($queryRes as $row)
            {
                $_cols[] = $row['Field'];

            }
        }
        return $_cols;
    }

    public function describe()
    {
        $queryRes =  $this->dbObj->describe($this->name);
        echo $this->dbObj->getDBName().' '.$this->name.'<br>';
        if($queryRes !== null)
        {
            foreach($queryRes as $row)
            {
                foreach($row as $value)
                {
                    print_r($value." ");
                }
                echo '<br>';
            }
        }
        else {
            echo "null";
        }
        echo '<br>';
    }

    public function delete($condition)
    {
        return $this->dbObj->delete($this->name,$condition);
    }

    public function update($row,$condition)
    {
        $filteredRow = $this->filterKeys($row);
        return $this->dbObj->update($this->name,$filteredRow,$condition);
    }

    public function conditionCreaterHelper($row,$logicalSeparator = 'AND')
    {
        $filteredRow = $this->filterKeys($row);
        $condition = "";
        $temp_arr = array_keys($filteredRow);
        $lastKey = end($temp_arr);
        foreach($filteredRow as $key => $value)
        {
            if(is_array($value))
            {
                $condition.="`{$key}` IN ";
                $condition.="( ";
                $temp_arr = array_keys($value);
                $innerLastKey = end($temp_arr);
                foreach($value as $temp_key => $temp_value)
                {
                    $condition.=$this->dbObj->appendValue($temp_value)." ";
                    if($temp_key !== $innerLastKey)
                    {
                        $condition.=", ";
                    }
                }
                $condition.=") ";
            }
            else 
            {
                $condition.= "`{$key}` = ";
                $condition.=$this->dbObj->appendValue($value)." ";
            }
            if($key != $lastKey)
                $condition.="{$logicalSeparator} ";
        }
        return $condition;
    }
}
