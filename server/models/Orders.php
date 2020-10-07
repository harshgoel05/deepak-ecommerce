<?php

namespace Models;

use Utility\CustomErrors;
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
            // echo "here" . '<br>';
            return $temp_res;
        } else return $this->dbObj->insert_id();
    }

    public function getFilteredOrders($data)
    {
        $condition = $this->conditionCreaterHelper($data);
        $allOrders = $this->find(null,$condition);
        $all = [];
        foreach($allOrders as $one)
        {
            $temp = $this->getOrders($one[ORDER_ID],$one['user_id']);
            if($temp instanceof Fallacy)
                return $temp;
            $all[]=$temp;
        }
        return $all;
    }

    public function getOrders($ids , $userId)
    {
        $orderIds = $ids;
        if ($ids !== null) {
            if (!is_array($ids)) {
                $ids = [$ids];
            }
            $conditionRow = [
                ORDER_ID => $ids,
                'user_id' => $userId
            ];
            $condition = $this->conditionCreaterHelper($conditionRow);
            $orders = $this->find(null, $condition);
        } else {
            $condition = "`user_id` = ${userId}";
            $orders = $this->find(null, $condition);
        }
        if ($orders instanceof Fallacy)
            return $orders;
        /* print_r($condition);
        echo '<br>'; */
        // print_r($orders);
        if ($orders->num_rows > 0) {
            if ($orderIds === null || is_array($orderIds)) {
                $orders = $orders->fetch_all(MYSQLI_ASSOC);
                foreach ($orders as &$order) {
                    $items = $this->getOrderDetails($order['order_id'], $userId);
                    if ($items instanceof Fallacy)
                        return $items;
                    $order['items'] = $items;
                }
                unset($order);
            } else {
                $orders = $orders->fetch_assoc();
                $items = $this->getOrderDetails($orders['order_id'], $userId);
                if ($items instanceof Fallacy)
                    return $items;
                $orders['items'] = $items;
            }
            return $orders;
        } else {
            if($orderIds === null || is_array($orderIds))
                return [];
            else return null;
        };
    }

    public function getOrderDetails($orderId, $userId)
    {
        $condition = "`order_id` = {$orderId} ";
        $ordersDetailsModel = \Models\OrdersDetails::getInstance();
        $rows = $ordersDetailsModel->findAllExceptGivenCols(['user_id'], $condition);
        $categoryItems = [];
        // print_r($rows);
        while ($row = $rows->fetch_array(MYSQLI_ASSOC)) {
            $categoryItems[$row['product_category']][] = $row;
        }
        $orderItems = [];
        $totalPrice = 0;
        foreach ($categoryItems as $category => $items) {
            /* print_r($items);
            echo '<br>'; */
            $productModel = getSingleton('\\Models\\Products\\', $category);
            $categoryItemsProIds = [];
            foreach ($items as $item) {
                if (!in_array($item[PRODUCT_ID], $categoryItemsProIds))
                    $categoryItemsProIds[] = $item[PRODUCT_ID];
            }
            $tempProducts = $productModel->findProductById($categoryItemsProIds);
            $categoryProducts = [];
            if (is_array($tempProducts)) {
                foreach ($tempProducts as $product) {
                    $categoryProducts[$product[PRODUCT_ID]] = $product;
                }
                // print_r($categoryProducts);
                foreach ($items as $item) {
                    // print_r($item);
                    $productid = $item[PRODUCT_ID];
                    // print_r($productid);
                    if (!array_key_exists($productid, $categoryProducts))
                        continue;
                    // print_r($productid);
                    $temp = array_merge($categoryProducts[$productid], $item);
                    $orderItems[] = $temp;
                }
            }
        }
        return $orderItems;
    }
    public function cancelOrder($order_id, $user_id)
    {
        $updationRow['order_status'] = ORDER_STATUS_FLAGS['CANCELLED'];
        $condition = "`user_id` = {$user_id} AND `order_id` = {$order_id} ";
        $temp_res = $this->find(null, $condition);
        if ($temp_res instanceof Fallacy)
            return $temp_res;
        if ($temp_res->num_rows > 0) {
            return $this->update($updationRow, $condition);
        } else return new Fallacy(CustomErrors::VALUE_ERROR, "no order found with given details");
    }

    public function returnOrder($order_id, $user_id)
    {
        $updationRow['order_status'] = ORDER_STATUS_FLAGS['RETURNED'];
        $condition = "`user_id` = {$user_id} AND `order_id` = {$order_id} ";
        $temp_res = $this->find(null, $condition);
        if ($temp_res instanceof Fallacy)
            return $temp_res;
        if ($temp_res->num_rows > 0) {
            return $this->update($updationRow, $condition);
        } else return new Fallacy(CustomErrors::VALUE_ERROR, "no order found with given details");
    }

    public function checkCoupon($couponCode)
    {
        $couponsModel = \Models\Coupons::getInstance();
        $coupon = $couponsModel->findByCouponCode($couponCode);

        if ($coupon instanceof Fallacy) {
            return $coupon;
        } else if ($coupon === null) {
            return new Fallacy(null,CustomErrors::valueNotFoundMessage(COUPON_CODE));
        }

        $couponUsedCount = $couponsModel->getCouponUsedCount($couponCode);

        if ($couponUsedCount > $coupon['use_limit']) {
            return new Fallacy(null,"Failed to apply coupon !! Coupon already expired or used maximum times");
        }

        return $coupon;
    }
}
