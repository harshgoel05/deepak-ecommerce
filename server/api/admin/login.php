<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/adminUsers.php');
require_once(__ROOT__.'/utility/network-helpers.php');
require_once(__ROOT__.'/config/field-consts.php');

addCommonHeaders();


$data = decodeRequestJson();

if($adminUsers->verifyPassword($data[USER_IDENTIFIER],$data[PASSWORD]))
{
    addAdminToSession($data[USER_IDENTIFIER]);
    sendSuccessResponse();
}

badRequestErrorHandler(CustomErrors::AUTH_ERROR);

