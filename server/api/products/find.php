<?php

use function Utility\HttpUtil\sendSuccessResponse;

require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('GET');

$dirs = glob('./*',GLOB_ONLYDIR);

$products = [];

foreach($dirs as $dir)
{
    $productModel = getSingleton('\\Models\\Products\\',$dir);
    $temp = $productModel->findProductsByInfo($_GET['search']);
    $products = array_merge($products,$temp);
    // echo $dir.'<br>';
}

sendSuccessResponse($products);

