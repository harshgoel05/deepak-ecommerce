<?php

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
// \Utility\SessionUtil\ensureAdminLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('GET');

$couponsModel = \Models\Coupons::getInstance();

if(array_key_exists(COUPON_CODE,$_GET))
{
    $temp_res = $couponsModel->findByCouponCode($_GET[COUPON_CODE]);
}
else $temp_res = $couponsModel->findByCouponCode(null);

if($temp_res instanceof Fallacy)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
}
else if($temp_res === null)
{
    \Utility\HttpUtil\sendFailResponse(CustomErrors::valueNotFoundMessage(COUPON_CODE));
}
else {
    \Utility\HttpUtil\sendSuccessResponse($temp_res);
}