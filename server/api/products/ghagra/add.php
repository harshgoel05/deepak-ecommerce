<?php
require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');
require_once(__ROOT__.'/models/all-models.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureAdminLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');

$data = \Utility\HttpUtil\decodeRequestJson();
// echo $data;
// echo $data['productType'];
$productModel = \Models\Products\Ghagra::getInstance();

if($productModel === null)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::VALUE_ERROR,\Utility\CustomErrors::invalidValueMessage('productType'));
}
$temp_res = $productModel->insertRow($data);
if($temp_res !== true) 
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::VALUE_ERROR,$temp_res);
}

Utility\HttpUtil\sendSuccessResponse();