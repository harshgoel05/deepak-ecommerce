<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/adminUsers.php');
require_once(__ROOT__.'/utility/network-helpers.php');

addCommonHeaders();
// echo file_get_contents('php://input');
$data = json_decode(file_get_contents('php://input'),true);
$res = $adminUsers->insertRow($data);
if($res !== true)
{
    badRequestErrorHandler($res);
}
else {
    echo json_encode([
        'success' => true,
    ]);
}