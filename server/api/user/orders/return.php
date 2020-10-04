<?php

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../../../config/other-configs.php');
require_once(__ROOT__ . '/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();

$user_id = \Utility\SessionUtil\getUserSessionIdentifier();
if (!array_key_exists(ORDER_ID, $data) || !is_numeric($data[ORDER_ID])) {
    $err = new Fallacy(CustomErrors::TYPE_ERROR, CustomErrors::invalidValueMessage(ORDER_ID));
    \Utility\HttpErrorHandlers\badRequestErrorHandler($err);
}
$order_id = $data['order_id'];

$ordersModel = \Models\Orders::getInstance();

$temp_res = $ordersModel->returnOrder($order_id, $user_id);

if ($temp_res instanceof Fallacy) {
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
}
\Utility\HttpUtil\sendSuccessResponse();
