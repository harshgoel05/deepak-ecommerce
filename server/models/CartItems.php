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
        $cartItems = parent::getItems($userId);
        $coupon = $cartModel->getCoupon($userId);
        foreach($cartItems as &$item)
        {
            $item[FINAL_SUBTOTAL_PRICE] = $item[SUBTOTAL_PRICE];
            if($coupon !== null)
            {
                $item[FINAL_SUBTOTAL_PRICE] -= $coupon[FLAT_OFF_AMOUNT];
                $item[FINAL_SUBTOTAL_PRICE] -= ($coupon[FLAT_OFF_PERCENTAGE]/100)*$item[FINAL_SUBTOTAL_PRICE];
            }
        }
        unset($item);
        return $cartItems;
    }
}