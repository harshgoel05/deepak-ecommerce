<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/users.php');
require_once(__ROOT__.'/utility/network-helpers.php');
require_once(__ROOT__.'/utility/error-handlers.php');

addCommonHeaders();
// echo file_get_contents('php://input');
$data = decodeRequestJson();
// var_dump($data);
if($data[PASSWORD] !== $data['confirm_password'])
{
    badRequestErrorHandler(CustomErrors::VALUE_ERROR,'Validation Failed');
}
$res = $users->insertRow($data);
if($res !== true)
{
    badRequestErrorHandler(CustomErrors::TYPE_ERROR,$res);
}
else {
   sendSuccessResponse();
}