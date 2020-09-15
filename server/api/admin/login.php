<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/adminUsers.php');
require_once(__ROOT__.'/utility/utilities.php');
require_once(__ROOT__.'/config/field-consts.php');

\Utility\HeadersUtil\addCommonHeaders();


$data = \Utility\HttpUtil\decodeRequestJson();

if($adminUsers->verifyPassword($data[USER_IDENTIFIER],$data[PASSWORD]))
{
    \Utility\SessionUtil\addAdminToSession($data[USER_IDENTIFIER]);
    \Utility\HttpUtil\sendSuccessResponse();
}

\Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::AUTH_ERROR);

