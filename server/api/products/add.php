<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/products.php');
require_once(__ROOT__.'/utility/utilities.php');
require_once(__ROOT__.'/auth/adminUsers.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureAdminLoggedIn();

$data = \Utility\HttpUtil\decodeRequestJson();
$temp_res = $products->insertRow($data);
if($temp_res !== true) 
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::VALUE_ERROR,$temp_res);
}

Utility\HttpUtil\sendSuccessResponse();