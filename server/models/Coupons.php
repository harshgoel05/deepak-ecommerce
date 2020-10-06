<?php
namespace Models;

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/utility/autoloader.php');

class Coupons extends Table
{
    protected function __construct()
    {
        $_name = 'coupons';
        $_dbObj = \Databases\UsersDB::getInstance();
        parent::__construct($_name,$_dbObj);
    }

    public function updateCoupon($couponCode,$update)
    {
        $condRow[COUPON_CODE] = $couponCode;
        $condition = $this->conditionCreaterHelper($condRow);
        $coupon = $this->find([COUPON_CODE],$condition);
        if($coupon->num_rows === 0)
        {
            return new Fallacy(CustomErrors::VALUE_ERROR,CustomErrors::valueNotFoundMessage(COUPON_CODE));
        }
        return $this->update($update,$condition);
    }

    public function findByCouponCode($couponCode = null)
    {
        if($couponCode !== null)
        {
            $temp_res =$this->find(null,$this->conditionCreaterHelper([COUPON_CODE => $couponCode]));
        }
        else {
            $temp_res = $this->find();
        }
        if($temp_res instanceof Fallacy)
            return $temp_res;
        if($temp_res->num_rows > 0)
        {
            if($couponCode === null)
                return $temp_res->fetch_all(MYSQLI_ASSOC);
            else return $temp_res->fetch_assoc();
        }
        else {
            if($couponCode === null)
                return [];
            else return null;
        }
    }
    public function getCouponUsedCount($couponCode) {
        $ordersModel = \Models\Orders::getInstance();
        $condRow[COUPON_CODE] = $couponCode;
        $sql = "SELECT COUNT( ".COUPON_CODE." ) FROM orders WHERE ";
        $sql.=$this->conditionCreaterHelper($condRow);
        $temp_res = $ordersModel->dbObj->query($sql);
        return $temp_res->fetch_array(MYSQLI_NUM)[0];
    }

}