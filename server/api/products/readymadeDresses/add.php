<?php

use Utility\Fallacy;

require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureAdminLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');

$data = \Utility\HttpUtil\decodeRequestJson(true);
// echo $data;
// echo $data['productType'];
$productModel = getSingleton('\\Models\\Products\\',__DIR__);

if($productModel === null)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(new Fallacy(\Utility\CustomErrors::VALUE_ERROR,\Utility\CustomErrors::invalidValueMessage('productType')));
}
$temp_res = $productModel->insertRow($data);
if($temp_res !== true) 
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
}

Utility\HttpUtil\sendSuccessResponse();