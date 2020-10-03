<?php

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../../../config/other-configs.php');
require_once(__ROOT__ . '/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();

// print_r($data);

$identifier = \Utility\SessionUtil\getUserSessionIdentifier();

$temp_data = [];
$temp_data['user_id'] = $identifier;

$ordersModel = \Models\Orders::getInstance();
$ordersDetailsModel = \Models\OrdersDetails::getInstance();

$ordersModel->dbObj->begin_transaction();
$orderId = $ordersModel->createOrder($temp_data);
// print_r($orderId);
// echo '<br>';
$allGood = true;
$toCommit[] = $ordersModel;
$totalPrice = 0;
foreach ($data as $detail) {
    $detail['order_id'] = $orderId;
    if (in_array($detail[PRODUCT_CATEGORY], PRODUCT_CATEGORIES)) {
        if (!array_key_exists($detail[PRODUCT_CATEGORY], $toCommit)) {
            $toCommit[$detail[PRODUCT_CATEGORY]] = getSingleton('\\Models\\Products\\', $detail[PRODUCT_CATEGORY]);
            $toCommit[$detail[PRODUCT_CATEGORY]]->dbObj->begin_transaction();
        }
    }
    $temp_res = $ordersDetailsModel->insertRow($detail);
    if ($temp_res instanceof Fallacy) {
        $allGood = false;
        foreach ($toCommit as $model) {
            $model->dbObj->rollback();
        }
        \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
        break;
    }
    $totalPrice += $temp_res;
}
$updationRow['total_price'] = $totalPrice;
$temp_res = $ordersModel->update($updationRow, "`id` = {$orderId}");
if ($temp_res instanceof Fallacy) {
    $allGood = false;
    foreach ($toCommit as $model) {
        $model->dbObj->rollback();
    }
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
}
foreach ($toCommit as $model) {
    if (!$model->dbObj->commit()) {
        $allGood = false;
        break;
    }
}

if ($allGood) {
    \Utility\HttpUtil\sendSuccessResponse();
} else {
    \Utility\HttpUtil\sendFailResponse("Commit to sql failed");
}
