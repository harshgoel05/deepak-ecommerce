<?php

use Utility\Fallacy;

require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');
// require_once(__ROOT__.'/models/all-models.php');

\Utility\HeadersUtil\addCommonHeaders();
// \Utility\SessionUtil\ensureAdminLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('GET');

// $productType = $_GET['productType'];
$productModel = getSingleton('\\Models\\Products\\',__DIR__);
// echo $productType.'<br>'.$_GET['productid'];
if($productModel === null)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(new Fallacy(\Utility\CustomErrors::VALUE_ERROR,\Utility\CustomErrors::invalidValueMessage('productType')));
}

if(array_key_exists('productid',$_GET))
    $temp_res = $productModel->findProductById($_GET['productid']);
else $temp_res = $productModel->findProductById(null);

if($temp_res !== null)
{
    \Utility\HttpUtil\sendSuccessResponse($temp_res);
}

\Utility\HttpUtil\sendFailResponse();