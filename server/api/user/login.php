<?php

use Utility\Fallacy;

require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');
require_once(__ROOT__.'/config/field-consts.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();
\Utility\SessionUtil\ensureNotLoggedIn();

$users = \Models\Users::getInstance();

if($users->verifyPassword($data[USER_IDENTIFIER],$data[PASSWORD]))
{
    \Utility\SessionUtil\addUserToSession($data[USER_IDENTIFIER]);
    \Utility\HttpUtil\sendSuccessResponse();
}

\Utility\HttpErrorHandlers\badRequestErrorHandler(new Fallacy(\Utility\CustomErrors::AUTH_ERROR));
