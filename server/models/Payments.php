<?php
namespace Models;
require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/models/Table.php');
require_once(__ROOT__.'/config/field-consts.php');
require_once(__ROOT__ . '/utility/autoloader.php');

class Payments extends Table {
    protected function __construct()
    {
        $_dbObj = \Databases\UsersDB::getInstance();
        $_name = 'ccavenue_payments';
        parent::__construct($_name, $_dbObj);
    }
}