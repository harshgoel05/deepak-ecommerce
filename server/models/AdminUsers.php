<?php
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/models/Table.php');
require_once(__ROOT__.'/database/db-connection.php');

class AdminUsers extends Table
{

    public function insertRow($row)
    {
        if(! $this->validateRow($row,['email','password','username']))
        {
            return "Validation error";
        }
        if(isset($row[PASSWORD]))
            $row[PASSWORD] = password_hash($row[PASSWORD],PASSWORD_DEFAULT);
        return parent::insertRow($row);
    }
    public function verifyPassword($identifier,$_password)
    {
        global $db;
        $identifier = $db->escape_string($identifier);
        $row = $this->find([PASSWORD],"`email` = '{$identifier}'");
        if($row->num_rows > 0)
            $hashedPassword = $row->fetch_assoc()[PASSWORD];
        else {
            return false;
        }
        return password_verify($_password,$hashedPassword);
    }
    public function getProfile($identifier)
    {
        global $db;
        $identifier = $db->escape_string($identifier);
        $res = $this->findAllExceptGivenCols(['user_id',PASSWORD],USER_IDENTIFIER." = '{$identifier}'");
        if($res->num_rows > 0)
            return $res->fetch_assoc();
        else return false;
    }
}