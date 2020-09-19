<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');
require_once(__ROOT__.'/auth/adminUsers.php');
require_once(__ROOT__.'/models/all-models.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureAdminLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');

$data = \Utility\HttpUtil\decodeRequestJson();
$productModel = \Models\Products\getProductModel($data['productType']);

if($productModel === null)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::VALUE_ERROR,\Utility\CustomErrors::invalidValueMessage('productType'));
}
$temp_res = $products->insertRow($data);
if($temp_res !== true) 
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::VALUE_ERROR,$temp_res);
}

Utility\HttpUtil\sendSuccessResponse();