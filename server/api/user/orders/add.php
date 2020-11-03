<?php

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../../../config/other-configs.php');
require_once(__ROOT__ . '/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();
\Utility\HttpUtil\ensureFields($data,['items','delivery_person_name']);
// print_r($data);

$identifier = \Utility\SessionUtil\getUserSessionIdentifier();

$data['user_id'] = $identifier;

$ordersModel = \Models\Orders::getInstance();
$ordersDetailsModel = \Models\OrdersDetails::getInstance();
$couponsModel = \Models\Coupons::getInstance();

$ordersModel->dbObj->begin_transaction();
$orderId = $ordersModel->createOrder($data);
// print_r($orderId);
// echo '<br>';
$allGood = true;
$toCommit[] = $ordersModel;
$totalPrice = 0;
$items = $data['items'];

$coupon = null;
if(!empty($data[COUPON_CODE]))
{
    $coupon = $ordersModel->checkCoupon($data[COUPON_CODE]);
    if($coupon instanceof Fallacy)
    {
        if($coupon->getType() === null)
        {
            \Utility\HttpUtil\sendFailResponse($coupon->getMessage());
        }
        else {
            \Utility\HttpErrorHandlers\badRequestErrorHandler($coupon);
        }
    }
}

foreach ($items as $item) {
    $item[COUPON] = $coupon;
    $item['order_id'] = $orderId;
    if (in_array($item[PRODUCT_CATEGORY], PRODUCT_CATEGORIES)) {
        if (!array_key_exists($item[PRODUCT_CATEGORY], $toCommit)) {
            $toCommit[$item[PRODUCT_CATEGORY]] = getSingleton('\\Models\\Products\\', $item[PRODUCT_CATEGORY]);
            $toCommit[$item[PRODUCT_CATEGORY]]->dbObj->begin_transaction();
        }
    }
    $temp_res = $ordersDetailsModel->insertRow($item);
    if ($temp_res instanceof Fallacy) {
        $allGood = false;
        foreach ($toCommit as $model) {
            $model->dbObj->rollback();
        }
        \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
        break;
    }
}
$updationRow[TOTAL_AMOUNT] = 0;
$updationRow[FINAL_AMOUNT] = 0;

$items = $ordersModel->getOrderDetails($orderId,$identifier);

foreach($items as $item)
{
    $updationRow[TOTAL_AMOUNT]+=$item[SUBTOTAL_PRICE];
    $updationRow[FINAL_AMOUNT]+=$item[FINAL_SUBTOTAL_PRICE];
}
if($coupon !== null)
{
    $updationRow[FINAL_AMOUNT]-=$coupon[FLAT_OFF_AMOUNT];
}
if($coupon !== null && $updationRow[TOTAL_AMOUNT] < $coupon[MINIMUM_AMOUNT_NEEDED])
{
    $temp_res = new Fallacy(null,"Failed to apply coupon !! Cart total amount needs to be equal to or greater than {$coupon[MINIMUM_AMOUNT_NEEDED]}");
}
else {
    $temp_res = $ordersModel->update($updationRow, "`order_id` = {$orderId}");
}
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
    $data = [];
    $data['order_id'] = $orderId;
    \Utility\HttpUtil\sendSuccessResponse($data);
} else {
    \Utility\HttpUtil\sendFailResponse("Commit to sql failed");
}
