<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/products.php');
require_once(__ROOT__.'/utility/network-helpers.php');
require_once(__ROOT__.'/auth/adminUsers.php');



addCommonHeaders();

$res = [
    'success' => 0,
    'error' => null,
];
$status_code = HTTP_OK;
$data = decodeRequestJson();
$temp_res = $products->insertRow($_POST);
if($temp_res !== true) 
{
    $status_code= HTTP_BAD_REQUEST;
    $res['error'] = [
        'type' => 'ValueError',
        'message' => $temp_res, 
    ];
}

http_response_code($status_code);
echo json_decode($res);