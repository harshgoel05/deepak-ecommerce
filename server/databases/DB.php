<?php

namespace Databases;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/config/database.php');


class DB
{
    private $db;
    protected function __construct($databaseName)
    {
        $this->db = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, $databaseName);

        if ($this->db->connect_error) {
            die("Connection to the database `{$databaseName}` failed : " . $this->db->connect_error);
        }
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

    private function appendValue($val)
    {
        if (is_string($val)) {
            $val = '"' . $this->db->escape_string($val) . '"';
        }
        return $val;
    }

    public function insertRow($tableName, $row)
    {
        $keys = '';
        $values = '';
        $lastkey = end(array_keys($row));
        $sql = "INSERT INTO `{$tableName}` (";
        foreach ($row as $key => $value) {
            $key = $this->db->escape_string($key);
            $value = $this->db->escape_string($value);
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
        $sql .= ')';
        // echo $sql.'<br>';
        if ($this->db->query($sql)) {
            return true;
        } else return $this->db->error;
    }

    public function find($tableName, $cols = null, $query = null, $extras = null)
    {
        $sql = "SELECT ";
        if (count($cols)) {
            for ($i = 0; $i < count($cols); $i++) {
                $cols[$i] = $this->db->escape_string($cols[$i]);
                $sql .= "`{$cols[$i]}`";
                if ($i !== count($cols) - 1)
                    $sql .= ' , ';
            }
        } else {
            $sql .= ' * ';
        }
        $sql .= "from `{$tableName}` ";
        if (count($query)) {
            $sql .= 'WHERE ';
            $sql .= $query;
        }
        // show($sql);
        $result = $this->db->query($sql);
        return $result;
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
}
