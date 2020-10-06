<?php

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('POST');
\Utility\SessionUtil\ensureAdminLoggedIn();
$data = \Utility\HttpUtil\decodeRequestJson(true);
\Utility\HttpUtil\ensureFields($data,[COUPON_CODE]);

$couponsModel = \Models\Coupons::getInstance();

$condRow[COUPON_CODE] = $data[COUPON_CODE];
$temp_res = $couponsModel->delete($couponsModel->conditionCreaterHelper($condRow));

if($temp_res instanceof Fallacy)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
}
else if($temp_res > 0)
{
    \Utility\HttpUtil\sendSuccessResponse();
}
else {
    $errr = new Fallacy(CustomErrors::VALUE_ERROR,CustomErrors::valueNotFoundMessage(COUPON_CODE));
}