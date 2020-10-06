<?php

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson(true);
\Utility\HttpUtil\ensureFields($data,[COUPON_CODE]);

$userId = \Utility\SessionUtil\getUserSessionIdentifier();

$cartModel = \Models\Cart::getInstance();

$temp_res = $cartModel->applyCoupon($userId,$data[COUPON_CODE]);

if($temp_res instanceof Fallacy)
{
    if($temp_res->getType() === null)
        \Utility\HttpUtil\sendFailResponse($temp_res->getMessage());
    else \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
}
else {
    \Utility\HttpUtil\sendSuccessResponse();
}

