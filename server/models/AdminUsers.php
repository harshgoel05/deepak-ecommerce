<?php
namespace Models;

require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__ . '/utility/autoloader.php');
require_once(__ROOT__.'/config/field-consts.php');

class AdminUsers extends Identifier
{

    protected function __construct()
    {
        $this->identifierCol = ADMIN_IDENTIFIER;
        $_dbObj = \Databases\AdminUsersDB::getInstance();
        $_name = 'databunker';
        parent::__construct($_name,$_dbObj);
    }
}