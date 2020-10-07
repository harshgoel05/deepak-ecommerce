<?php

use Utility\CustomErrors;
use Utility\Fallacy;

use function Utility\HeadersUtil\addCommonHeaders;

require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureAdminLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson(true);
\Utility\HttpUtil\ensureFields($data,[ORDER_ID,ORDER_STATUS]);

$ordersModel = \Models\Orders::getInstance();

if(!array_key_exists($data[ORDER_STATUS],ORDER_STATUS_FLAGS))
{
    $err = new Fallacy(CustomErrors::VALUE_ERROR,CustomErrors::invalidValueMessage(ORDER_STATUS));
    \Utility\HttpErrorHandlers\badRequestErrorHandler($err);
}
$condition = $ordersModel->conditionCreaterHelper($data);
$updationRow[ORDER_STATUS] = $data[ORDER_STATUS];
$temp_res = $ordersModel->update($updationRow,$condition);

if($temp_res instanceof Fallacy)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
}
else if ($temp_res === 0){
    \Utility\HttpUtil\sendFailResponse("Order with given details not found");
}
else {
    \Utility\HttpUtil\sendSuccessResponse();
}