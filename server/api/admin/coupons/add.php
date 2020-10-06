<?php

use Utility\Fallacy;

require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('POST');
\Utility\SessionUtil\ensureAdminLoggedIn();
$data = \Utility\HttpUtil\decodeRequestJson(true);
\Utility\HttpUtil\ensureFields($data,['coupon_code','min_amount_needed','use_limit']);

$couponsModel = \Models\Coupons::getInstance();

$temp_res = $couponsModel->insertRow($data);

if($temp_res instanceof Fallacy)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
}
else
{
    \Utility\HttpUtil\sendSuccessResponse();
}