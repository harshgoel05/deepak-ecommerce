<?php
namespace Models;

require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/models/Table.php');
require_once(__ROOT__.'/models/Identifier.php');
require_once(__ROOT__.'/databases/all-databases.php');
require_once(__ROOT__.'/config/field-consts.php');

class AdminUsers extends Identifier
{
    public static $instance = null;

    private function __construct()
    {
        $this->identifierCol = ADMIN_IDENTIFIER;
        $_dbObj = \Databases\AdminUsersDB::getInstance();
        $_name = 'databunker';
        $_cols = ['id','username','password','number'];
        parent::__construct($_name,$_cols,$_dbObj);
    }

    public static function getInstance() 
    {
        if(self::$instance === null)
        {
            self::$instance = new static();
        }
        return self::$instance; 
    }

    public function getProfile($identifier)
    {
        $identifier = $this->dbObj->db->escape_string($identifier);
        $res = $this->findAllExceptGivenCols(['id',PASSWORD],ADMIN_IDENTIFIER." = '{$identifier}'");
        if($res->num_rows > 0)
            return $res->fetch_assoc();
        else return false;
    }
}