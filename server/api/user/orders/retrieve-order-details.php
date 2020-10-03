<?php

use Utility\Fallacy;

require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('GET');

$orderId = $_GET['order_id'];
$userId = \Utility\SessionUtil\getUserSessionIdentifier();

$ordersModel = \Models\Orders::getInstance();

$temp_res = $ordersModel->getOrderDetails($orderId,$userId);

if($temp_res instanceof Fallacy)
{
    \Utility\HttpUtil\sendFailResponse($temp_res->getMessage());
}
else
{
    \Utility\HttpUtil\sendSuccessResponse($temp_res);
}