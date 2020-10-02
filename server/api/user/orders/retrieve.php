<?php

use Utility\Fallacy;

use function Utility\HttpUtil\sendSuccessResponse;

require_once(__DIR__ . '/../../../config/other-configs.php');
require_once(__ROOT__ . '/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('GET');

if (array_key_exists('order_id', $_GET))
    $orderId = $_GET['order_id'];
else $orderId = null;

$userId = \Utility\SessionUtil\getUserSessionIdentifier();

$ordersModel = \Models\Orders::getInstance();

$temp_res = $ordersModel->getOrders($orderId, $userId);

if ($temp_res instanceof Fallacy) {
    \Utility\HttpUtil\sendFailResponse($temp_res->getMessage());
} else {
    \Utility\HttpUtil\sendSuccessResponse();
}
