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

    public function updateCoupon($coupon_code,$update)
    {
        $condRow[COUPON_CODE] = $coupon_code;
        $condition = $this->conditionCreaterHelper($condRow);
        $coupon = $this->find([COUPON_CODE],$condition);
        if($coupon->num_rows === 0)
        {
            return new Fallacy(CustomErrors::VALUE_ERROR,CustomErrors::valueNotFoundMessage(COUPON_CODE));
        }
        return $this->update($update,$condition);
    }
}