<?php

use Utility\Fallacy;

use function Utility\HttpUtil\sendSuccessResponse;

require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');
require_once(__ROOT__.'/config/field-consts.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();

$product_categories = PRODUCT_CATEGORIES;
if(array_key_exists('product_categories',$data))
{
    $product_categories = $data['product_categories'];
}
if(!array_key_exists(FILTER_MIN_PRICE,$data))
{   
    $data[FILTER_MIN_PRICE] = 0;
}

if(!array_key_exists(FILTER_MAX_PRICE,$data))
{
    $data[FILTER_MAX_PRICE]= 1000000;
}
$products = [];
foreach($product_categories as $category)
{
    $productModel = getSingleton('\\Models\\Products\\',$category);
    $temp = $productModel->findProductsByInfo($data);
    if($temp instanceof Fallacy)
    {
        \Utility\HttpErrorHandlers\badRequestErrorHandler($temp);
    }
    $products = array_merge($products,$temp);
    // echo $category.'<br>';
}

sendSuccessResponse($products);

