<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/products.php');
require_once(__ROOT__.'/utility/network-helpers.php');
require_once(__ROOT__.'/auth/adminUsers.php');

addCommonHeaders();
ensureAdminLoggedIn();

$data = decodeRequestJson();
$temp_res = $products->insertRow($data);
if($temp_res !== true) 
{
    badRequestErrorHandler('ValueType',$temp_res);
}

sendSuccessResponse();