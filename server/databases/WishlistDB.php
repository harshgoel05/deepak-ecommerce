<?php
namespace Databases;
require_once(__DIR__.'/../config/other-configs.php');

class WishlistDB extends DB
{
    protected function __construct()
    {
        $_dbName = 'jewrzsmy_';
    }
}