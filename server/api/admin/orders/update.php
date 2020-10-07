<?php

use Utility\CustomErrors;
use Utility\Fallacy;

use function Utility\HeadersUtil\addCommonHeaders;

require_once(__DIR__ . '/../../../config/other-configs.php');
require_once(__ROOT__ . '/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureAdminLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson(true);
\Utility\HttpUtil\ensureFields($data, [ORDER_ID, "update"]);
\Utility\HttpUtil\ensureFields($data['update'], [ORDER_STATUS]);

$ordersModel = \Models\Orders::getInstance();

if (!in_array($data[ORDER_STATUS], ORDER_STATUS_FLAGS)) {
    $err = new Fallacy(CustomErrors::VALUE_ERROR, CustomErrors::invalidValueMessage(ORDER_STATUS));
    \Utility\HttpErrorHandlers\badRequestErrorHandler($err);
}
$condition = $ordersModel->conditionCreaterHelper($data);
$temp_res = $ordersModel->find([ORDER_ID], $condition);

if ($temp_res instanceof Fallacy) {
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
} else if ($temp_res->num_rows === 0) {
    \Utility\HttpUtil\sendFailResponse("Order with given details not found");
}
$temp_res = $ordersModel->update($data['update'], $condition);
if ($temp_res instanceof Fallacy) {
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
}
else if($temp_res === 0)
{
    \Utility\HttpUtil\sendFailResponse("nothing to update , order is already having same values as given for the update");
} 
else {
    \Utility\HttpUtil\sendSuccessResponse();
}
