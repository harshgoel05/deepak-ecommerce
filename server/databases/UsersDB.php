<?php
namespace Databases;
require_once(__DIR__.'/../config/other-configs.php');

class UsersDB extends DB
{
    protected function __construct()
    {
        $_dbName = 'jewrzsmy_deepakmem';
        parent::__construct($_dbName);
    }
}