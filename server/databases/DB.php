<?php

namespace Databases;

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/config/database.php');
require_once(__ROOT__.'/utility/autoloader.php');

abstract class DB
{
    protected $db;
    protected $dbName;
    public function escape_string($str)
    {
        return $this->db->escape_string($str);
    }
    protected function __construct($databaseName = null)
    {
        $this->dbName = $databaseName;
        $this->db = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, $databaseName);

        if ($this->db->connect_error) {
            die("Connection to the database `{$databaseName}` failed : " . $this->db->connect_error);
        }
        if(!($this->db->query("SET SESSION sql_mode = 'STRICT_ALL_TABLES'")))
        {
            echo "unable to set sql_mode to STRICT_ALL_TABLES";
            exit();
        }
    }

    public function query($sql)
    {
        return $this->db->query($sql);
    }

    public function begin_transaction()
    {
        $this->db->begin_transaction();
    }

    public function commit()
    {
        return $this->db->commit();
    }

    public function rollback()
    {
        return $this->db->rollback();
    }

    public function insert_id()
    {
        return $this->db->insert_id;
    }

    protected static $instances = [];
    public function getDBName()
    {
        return $this->dbName;
    }
    public static function getInstance()
    {
        $className = static::class;
        if (!isset(self::$instances[$className])) {
            self::$instances[$className] = new static();
        }
        return self::$instances[$className];
    }

    public function createTable($tableName, $tableCols, $extras = null)
    {
        $sql = "CREATE TABLE `{$tableName}` (";
        $temp_keys = array_keys($tableCols);
        $lastkey = end($temp_keys);
        foreach ($tableCols as $colName => $colS)    //colS means column specification
        {
            $sql .= "`" . $this->db->escape_string($colName) . "`" . ' ' . $colS;
            if ($colName !== $lastkey)
                $sql .= ',';
        }
        if ($extras) {
            foreach ($extras as $value) {
                $sql .= "," . $value;
            }
        }
        $sql .= ')';
        // echo $sql.'<br><br>';
        if ($this->db->query($sql)) {
            return true;
        } else return $this->db->error;
    }

    public function appendValue($val)
    {
        // print_r($val);
        // echo '<br>';
        if (is_string($val)) {
            $val = '"' . $this->db->escape_string($val) . '"';
        }
        return $val;
    }

    public function insertRow($tableName, $row,$extra = null)
    {
        $keys = '';
        $values = '';
        $temp_arr = array_keys($row);
        $lastkey = end($temp_arr);
        $sql = "INSERT INTO `{$tableName}` (";
        foreach ($row as $key => $value) {
            $key = $this->db->escape_string($key);
            $keys .= "`{$key}`";
            $values .= $this->appendValue($value);
            if ($key !== $lastkey) {
                $keys .= ' , ';
                $values .= ' , ';
            }
        }
        $sql .= $keys;
        $sql .= ') VALUES (';
        $sql .= $values;
        $sql .= ') ';
        if($extra !== null)
        {
            $sql.=$extra;
        }
        // echo $sql.'<br>';
        if ($this->db->query($sql)) {
            return true;
        } else return new Fallacy(CustomErrors::TYPE_ERROR,$this->db->error);
    }

    public function find($tableName, $cols = null, $query = null, $extras = null)
    {
        $sql = "SELECT ";
        if (is_array($cols) && count($cols)) {
            for ($i = 0; $i < count($cols); $i++) {
                $cols[$i] = $this->db->escape_string($cols[$i]);
                $sql .= "`{$cols[$i]}`";
                if ($i !== count($cols) - 1)
                    $sql .= ' , ';
                else
                    $sql .= ' ';
            }
        } else {
            $sql .= ' * ';
        }
        $sql .= "from `{$tableName}` ";
        if (!empty($query)) {
            $sql .= 'WHERE ';
            $sql .= $query;
        }
        // echo $sql.'<br>';
        // echo $this->dbName.'<br>';
        $result = $this->db->query($sql);
        // echo $result->num_rows.'<br>';
        // print_r($result->fetch_assoc());
        return $result;
    }

    public function error()
    {
        return $this->db->error;
    }

    public function drop($tableName)
    {
        $tableName = $this->db->escape_string($tableName);
        $sql = "DROP TABLE `{$tableName}`";
        if ($this->db->query($sql))
            return true;
        else
            return $this->db->error;
    }
    public function describe($tableName, $resultType = MYSQLI_NUM)
    {
        $tableName = $this->db->escape_string($tableName);
        $sql = "DESCRIBE {$tableName}";
        $res = $this->db->query($sql);
        if ($res->num_rows > 0)
            return $res->fetch_all($resultType);
        else return null;
    }

    public function delete($tableName, $condition = null)
    {
        $sql = "DELETE FROM `{$tableName}`";
        if($condition !== null)
        {
            $sql.=" WHERE $condition";
        }
        // echo $sql.'<br>';
        if($this->db->query($sql))
        {
            return $this->db->affected_rows;
        }
        else 
            return new Fallacy(CustomErrors::TYPE_ERROR,$this->db->error);
    }

    public function update($tableName,$row,$condition)
    {
        $sql = "UPDATE {$tableName} ";
        $sql .= "SET ";
        $temp_arr = array_keys($row);
        $lastKey = end($temp_arr);
        foreach($row as $key => $val)
        {
            $sql.= $key." = ";
            $sql.=$this->appendValue($val);
            if($key !== $lastKey)
            {
                $sql.=" , ";
            }
            else
            {
                $sql.=" ";
            }
        }
        $sql.="WHERE ";
        $sql.=$condition;
        // echo $sql.'<br>';
        if($this->db->query($sql))
        {
            return $this->db->affected_rows;
        }
        else
            return new Fallacy(CustomErrors::TYPE_ERROR,$this->db->error);
    }
}
