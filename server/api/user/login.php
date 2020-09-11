<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/users.php');
require_once(__ROOT__.'/utility/network-helpers.php');
require_once(__ROOT__.'/config/field-consts.php');
require_once(__ROOT__.'/utility/error-handlers.php');

addCommonHeaders();

$data = decodeRequestJson();


if($users->verifyPassword($data[USER_IDENTIFIER],$data[PASSWORD]))
{
    addUserToSession($data[USER_IDENTIFIER]);
    sendSuccessResponse();
}

badRequestErrorHandler(CustomErrors::AUTH_ERROR);
