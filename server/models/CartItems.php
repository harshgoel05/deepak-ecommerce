<?php
namespace Models;
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/utility/autoloader.php');

class CartItems extends Wagon
{
    public function __construct()
    {
        $_dbObj = \Databases\UsersDB::getInstance();
        $_name = 'cart_items';
        parent::__construct($_name,$_dbObj);
    }

    public function getItems($userId)
    {
        $cartModel = \Models\Cart::getInstance();
        $items = parent::getItems($userId);
        // print_r($items);
        $coupon = $cartModel->getCoupon($userId);
        // print_r($coupon);
        foreach($items as &$item)
        {
            $item[FINAL_SUBTOTAL_PRICE] = $item[SUBTOTAL_PRICE];
            if($coupon !== null)
            {
                $temp = min($coupon[FLAT_OFF_AMOUNT],$item[FINAL_SUBTOTAL_PRICE]);
                $item[FINAL_SUBTOTAL_PRICE] -= $temp;
                $item[FINAL_SUBTOTAL_PRICE] -= ($coupon[FLAT_OFF_PERCENTAGE]/100)*$item[FINAL_SUBTOTAL_PRICE];
                $coupon[FLAT_OFF_AMOUNT]-=$temp;
            }
        }
        unset($item);
        return $items;
    }
}