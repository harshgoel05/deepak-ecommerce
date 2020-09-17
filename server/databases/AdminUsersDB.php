<?php
namespace Databases;
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/databases/DB.php');
class AdminUsersDB extends DB 
{
    protected function __construct()
    {
        $this->dbName = 'deepakemp';
        parent::__construct($this->dbName);
    }

}