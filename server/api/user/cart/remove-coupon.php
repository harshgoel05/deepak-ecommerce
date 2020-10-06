<?php

use Utility\Fallacy;

require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');

$cartModel = \Models\Cart::getInstance();
$condRow['user_id'] = \Utility\SessionUtil\getUserSessionIdentifier();

$temp_res = $cartModel->delete($cartModel->conditionCreaterHelper($condRow));

if($temp_res instanceof Fallacy)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
}
else if($temp_res === 0)
{
    \Utility\HttpUtil\sendFailResponse("No coupon found to be removed");
}
else {
    \Utility\HttpUtil\sendSuccessResponse();
}