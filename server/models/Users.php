<?php
namespace Models;
require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/models/Table.php');
require_once(__ROOT__.'/config/field-consts.php');
require_once(__ROOT__ . '/utility/autoloader.php');

class Users extends Identifier
{
    protected function __construct()
    {
        $this->identifierCol = USER_IDENTIFIER;
        $_dbObj = \Databases\UsersDB::getInstance();
        $_name = 'cred';
        parent::__construct($_name,$_dbObj);
    }
}
