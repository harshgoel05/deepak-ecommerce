<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/adminUsers.php');
require_once(__ROOT__.'/utility/network-helpers.php');

addCommonHeaders();


$data = decodeRequestJson();

$res = [
    'success' => false,
];

if($adminUsers->verifyPassword($data[USER_IDENTIFIER],$data['password']))
{
    addAdminToSession($data[USER_IDENTIFIER]);
    $res['success'] = true;
}

echo json_encode($res);

