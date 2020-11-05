<?php

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();
\Utility\SessionUtil\ensureNotLoggedIn();
\Utility\HttpUtil\ensureFields($data,['email']);
$userModel = \Models\Users::getInstance();
$userId = $userModel->getUserIdByEmail($data['email']);

// echo "{$data['email']}<br>{$userId}";

if($userId === null)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(new Fallacy(CustomErrors::VALUE_ERROR,CustomErrors::valueNotFoundMessage('user')));
}
$res = $userModel->setResetPasswordOtp($userId);
if($res instanceof Fallacy)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($res);
}
if($res === false)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(new Fallacy(CustomErrors::SERVER_ERROR,null));
}

\Utility\HttpUtil\sendSuccessResponse();