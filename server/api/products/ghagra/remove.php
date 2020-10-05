<?php
require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');
require_once(__ROOT__.'/config/field-consts.php');

// \Utility\SessionUtil\ensureAdminLoggedIn();
\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();
\Utility\HttpUtil\ensureFields($data,[PRODUCT_ID]);

$productModel = getSingleton('\\Models\\Products\\',__DIR__);

// echo get_class($productModel);
// echo $data[PRODUCT_ID];
$temp_res = $productModel->removeProductById($data[PRODUCT_ID]);

if($temp_res === true)
{
    \Utility\HttpUtil\sendSuccessResponse();
}
else if($temp_res === false)
{
    \Utility\HttpUtil\sendFailResponse(\Utility\CustomErrors::valueNotFoundMessage(PRODUCT_ID));
}
else
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);