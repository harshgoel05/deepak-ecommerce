<?php
namespace Models;

use Utility\Fallacy;

require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/utility/autoloader.php');

class Orders extends Table
{
    protected function __construct()
    {
        $_dbObj = \Databases\UsersDB::getInstance();
        $_name = 'orders';
        parent::__construct($_name,$_dbObj);
    }
    public function createOrder($data)
    {
        $temp_res = $this->insertRow($data);
        if($temp_res instanceof Fallacy)
            return $temp_res;
        else return $this->dbObj->insert_id;
    }
}
