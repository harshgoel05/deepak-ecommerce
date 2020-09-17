<?php
namespace Databases;
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/databases/DB.php');
class AdminUsersDB extends DB 
{
    private static $instance = null;
    protected $dbName;

    private function __construct()
    {
        $this->dbName = 'deepakemp';
        parent::__construct($this->dbName);
    }

    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new static();
        }
        return self::$instance;
    }
}