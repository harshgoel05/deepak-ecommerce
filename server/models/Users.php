<?php
namespace Models;
require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/models/Table.php');
require_once(__ROOT__.'/config/field-consts.php');

class Users extends Identifier
{
    protected function __construct()
    {
        $this->identifierCol = USER_IDENTIFIER;
        $_dbObj = \Databases\UsersDB::getInstance();
        $_name = 'databunker';
        parent::__construct($_name,$_dbObj);
    }

    public function getProfile($identifier)
    {
        global $db;
        $identifier = $db->escape_string($identifier);
        $res = $this->findAllExceptGivenCols(['user_id',PASSWORD],USER_IDENTIFIER." = '{$identifier}'");
        if($res->num_rows > 0)
            return $res->fetch_assoc();
        else return null;
    }
}
