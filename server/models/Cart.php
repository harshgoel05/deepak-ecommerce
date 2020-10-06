<?php

namespace Models;

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/utility/autoloader.php');

class Cart extends Table
{
    protected function __construct()
    {
        $_name = 'cart';
        $_dbObj = \Databases\UsersDB::getInstance();
    }

    public function applyCoupon($userId, $couponCode)
    {
        $couponsModel = \Models\Coupons::getInstance();
        $coupon = $couponsModel->findByCouponCode($couponCode);

        if ($coupon instanceof Fallacy) {
            return $coupon;
        } else if ($coupon === null) {
            return new Fallacy(null,CustomErrors::valueNotFoundMessage(COUPON_CODE));
        }
        $cartItemsModel = \Models\CartItems::getInstance();
        $cartAmount = $cartItemsModel->getTotalAmount($userId);
        if ($cartAmount < $coupon[MINIMUM_AMOUNT_NEEDED]) {
            return new Fallacy(null,"Failed to apply coupon !! Cart total amount needs to be equal to or greater than {$coupon[MINIMUM_AMOUNT_NEEDED]}");
        }

        $couponUsedCount = $couponsModel->getCouponUsedCount($couponCode);

        if ($couponUsedCount >= $coupon['use_limit']) {
            return new Fallacy(null,"Failed to apply coupon !! Coupon already expired or used maximum times");
        }

        $row['user_id'] = $userId;
        $row[COUPON_CODE] = $couponCode;

        $temp_res = $this->insertRow($row);
        return $temp_res;
    }

    public function getCoupon($userId)
    {
        $condRow['user_id'] = $userId;
        $temp_res = $this->find(COUPON_CODE,$this->conditionCreaterHelper($condRow));
        if($temp_res->num_rows > 0)
            return $temp_res->fetch_array(MYSQLI_NUM)[0];
        else return null;
    }
}
