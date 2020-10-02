<?php

use Utility\Fallacy;

require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();

$identifier = \Utility\SessionUtil\getUserSessionIdentifier();

$data['user_id'] = $identifier;

$ordersModel = \Models\Orders::getInstance();
$ordersDetailsModel = \Models\OrdersDetails::getInstance();

$orderId = $ordersModel->createOrder($data);

$ordersModel->dbObj->begin_transaction();
$allGood = true;

foreach($data as $detail)
{
    $detail['order_id'] = $orderId;
    $temp_res = $ordersDetailsModel->insertRow($data);
    if($temp_res instanceof Fallacy)
    {
        $allGood = false;
        $ordersModel->dbObj->rollback();
        \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
        break;
    }
}
if($ordersModel->dbObj->commit())
{
    \Utility\HttpUtil\sendSuccessResponse();
}
else
{
    \Utility\HttpUtil\sendFailResponse("Commit to sql failed");
}