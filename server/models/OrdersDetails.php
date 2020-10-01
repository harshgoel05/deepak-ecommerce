<?php
namespace Models;
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/utility/autoloader.php');

class OrdersDetails extends Table
{
    protected function __construct()
    {
        $_dbObj = \Databases\UsersDB::getInstance();
        $_name = 'orders_details';
        parent::__construct($_name,$_dbObj);
    }

}