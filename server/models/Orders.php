<?php

namespace Models;

use Utility\Fallacy;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/utility/autoloader.php');

class Orders extends Table
{
    protected function __construct()
    {
        $_dbObj = \Databases\UsersDB::getInstance();
        $_name = 'orders';
        parent::__construct($_name, $_dbObj);
    }
    public function createOrder($data)
    {
        // print_r($data);
        $temp_res = $this->insertRow($data);
        if ($temp_res instanceof Fallacy) {
            echo "here" . '<br>';
            return $temp_res;
        } else return $this->dbObj->insert_id();
    }
    public function getOrders($ids = null, $userId)
    {
        $orderIds = $ids;
        if ($ids !== null) {


            if (!is_array($ids)) {
                $ids = [$ids];
            }
            $condition = "`id` in ( ";
            $condition .= implode(',', $ids) . ' ';
            $condition .= ") ";
            $condition .= "AND `user_id` = ${userId}";
            $orders = $this->find(null, $condition);
        } else {
            $condition = "`user_id` = ${userId}";
            $orders = $this->find(null,$condition);
        }
        if ($orders instanceof Fallacy)
            return $orders;
        if ($orders->num_rows > 0) {
            if ($orderIds === null || is_array($orderIds))
                return $orders->fetch_all(MYSQLI_ASSOC);
            else return $orders->fetch_assoc();
        } else return null;
    }
}
