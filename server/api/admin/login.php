<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');
require_once(__ROOT__.'/config/field-consts.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('POST');

$data = \Utility\HttpUtil\decodeRequestJson();
$adminUsers = \Models\AdminUsers::getInstance();
if($adminUsers->verifyPassword($data[ADMIN_IDENTIFIER],$data[PASSWORD]))
{
    \Utility\SessionUtil\addAdminToSession($data[ADMIN_IDENTIFIER]);
    \Utility\HttpUtil\sendSuccessResponse();
}

\Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::AUTH_ERROR);

