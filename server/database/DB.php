<?php
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__ . '/database/db-connection.php');

class DB
{
    public static function createTable($tableName, $tableCols, $extras)
    {
        global $db;
        $sql = "CREATE TABLE `{$tableName}` (";
        $lastkey = end(array_keys($tableCols));
        foreach ($tableCols as $colName => $colS)    //colS means column specification
        {
            $sql .= "`".$colName."`" . ' ' . $colS;
            if ($colName !== $lastkey)
                $sql .= ',';
        }
        foreach ($extras as $value) {
            $sql.= ",".$value;
        }
        $sql .= ')';
        // echo $sql.'<br><br>';
        if ($db->query($sql)) {
            return true;
        } else return $db->error;
    }
}
