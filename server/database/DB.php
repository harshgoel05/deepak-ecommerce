<?php
require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/database/db-connection.php');

class DB
{
    public static function createTable($tableName, $tableCols, $extras = null)
    {
        global $db;
        $sql = "CREATE TABLE `{$tableName}` (";
        $temp_keys = array_keys($tableCols);
        $lastkey = end($temp_keys);
        foreach ($tableCols as $colName => $colS)    //colS means column specification
        {
            $sql .= "`" . $db->escape_string($colName) . "`" . ' ' . $colS;
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
        if ($db->query($sql)) {
            return true;
        } else return $db->error;
    }

    private static function appendValue($val)
    {
        global $db;
        if (is_string($val)) {
            $val = '"' . $db->escape_string($val) . '"';
        }
        return $val;
    }

    public static function insertRow($tableName, $row)
    {
        global $db;
        $keys = '';
        $values = '';
        $lastkey = end(array_keys($row));
        $sql = "INSERT INTO `{$tableName}` (";
        foreach ($row as $key => $value) {
            $key = $db->escape_string($key);
            $value = $db->escape_string($value);
            $keys .= "`{$key}`";
            $values .= self::appendValue($value);
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
        if ($db->query($sql)) {
            return true;
        } else return $db->error;
    }

    public static function find($tableName, $cols = null, $query = null, $extras = null)
    {
        global $db;

        $sql = "SELECT ";
        if (count($cols)) {
            for ($i = 0; $i < count($cols); $i++) {
                $cols[$i] = $db->escape_string($cols[$i]);
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
        $result = $db->query($sql);
        return $result;
    }
}
