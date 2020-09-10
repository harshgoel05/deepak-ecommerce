<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/adminUsers.php');
require_once(__ROOT__.'/utility/network-helpers.php');
require_once(__ROOT__.'/config/field-consts.php');

addCommonHeaders();


$data = decodeRequestJson();
$response = [
    'success' => false,
];

if($adminUsers->verifyPassword($data[USER_IDENTIFIER],$data[PASSWORD]))
{
    addAdminToSession($data[USER_IDENTIFIER]);
    $response['success'] = true;
}

http_response_code(HTTP_OK);
echo json_encode($res);

