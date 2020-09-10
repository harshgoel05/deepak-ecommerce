<?php
require(__DIR__.'/../../config/other-configs.php');
require(__ROOT__.'/database/schemas/products.php');

$res = [
    'success' => 0,
    'error' => null,
];
$status_code = 200;
$temp_res = $products->insertRow($_POST);
if($temp_res !== true) 
{
    $status_code=400;
    $res['error'] = [
        'type' => 'ValueError',
        'message' => $temp_res, 
    ];
}

http_response_code($status_code);
return json_decode($res);