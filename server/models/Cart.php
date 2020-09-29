<?php
namespace Models;
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/utility/autoloader.php');

class Cart extends Wagon
{
    public function __construct()
    {
        $_dbObj = \Databases\UsersDB::getInstance();
        $_name = 'cart';
        parent::__construct($_name,$_dbObj);
    }
}