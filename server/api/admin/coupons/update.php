<?php

use Utility\Fallacy;

require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('POST');
\Utility\SessionUtil\ensureAdminLoggedIn();
$data = \Utility\HttpUtil\decodeRequestJson(true);
\Utility\HttpUtil\ensureFields($data,[COUPON_CODE,'update']);

$couponsModel = \Models\Coupons::getInstance();

$temp_res = $couponsModel->update($data[COUPON_CODE],$data['update']);

if($temp_res instanceof Fallacy)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
}
else
{
    \Utility\HttpUtil\sendSuccessResponse();
}