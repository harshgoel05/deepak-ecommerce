<?php
require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');
require_once(__ROOT__.'/config/field-consts.php');

// \Utility\SessionUtil\ensureAdminLoggedIn();
\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('POST');

$data = \Utility\HttpUtil\decodeRequestJson();

$relDirName = \Utility\ArraysUtil\getLastExplodedElem('/',__DIR__);

$modelClassName = '\\Models\\Products\\'.ucfirst($relDirName);

$productModel = $modelClassName::getInstance();

// echo get_class($productModel);
// echo $data[PRODUCT_ID];
$temp_res = $productModel->removeByProductID($data[PRODUCT_ID]);

if($temp_res === true)
{
    \Utility\HttpUtil\sendSuccessResponse();
}
else if($temp_res === false)
{
    \Utility\HttpUtil\sendFailResponse(\Utility\CustomErrors::valueNotFoundMessage('productid'));
}
else
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::VALUE_ERROR,$temp_res);