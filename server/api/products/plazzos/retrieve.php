<?php
require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
// \Utility\SessionUtil\ensureAdminLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('GET');

// $productType = $_GET['productType'];
$productModel = \Models\Products\Plazzos::getInstance();
// echo $productType.'<br>'.$_GET['productid'];
if($productModel === null)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::VALUE_ERROR,\Utility\CustomErrors::invalidValueMessage('productType'));
}

$temp_res = $productModel->findByProductID($_GET['productid']);
if($temp_res !== null)
{
    \Utility\HttpUtil\sendSuccessResponse($temp_res);
}

\Utility\HttpUtil\sendFailResponse();