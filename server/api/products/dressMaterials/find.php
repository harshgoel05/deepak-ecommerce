<?php

use function Utility\HttpUtil\sendSuccessResponse;

require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('GET');

$productModel = getSingleton('\\Models\\Products\\',__DIR__);

$products = $productModel->findProductsByInfo($_GET['search']);

sendSuccessResponse($products);

