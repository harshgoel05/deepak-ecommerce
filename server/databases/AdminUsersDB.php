<?php
namespace Databases;

class AdminUsersDB extends DB 
{
    private static $instance = null;
    public $dbName;

    private function __construct()
    {
        $this->dbName = 'deepakemp';
        parent::__construct($this->dbname);
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