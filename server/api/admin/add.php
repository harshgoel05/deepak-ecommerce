<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/adminUsers.php');
require_once(__ROOT__.'/utility/network-helpers.php');
require_once(__ROOT__.'/utility/error-handlers.php');

addCommonHeaders();
// echo file_get_contents('php://input');
$data = decodeRequestJson();
// var_dump($data);
$res = $adminUsers->insertRow($data);
if($res !== true)
{
    badRequestErrorHandler(CustomErrors::TYPE_ERROR,$res);
}
else {
    sendSuccessResponse();
}