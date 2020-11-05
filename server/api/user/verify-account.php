<?php

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('GET');
\Utility\HttpUtil\ensureFields($_GET,['email','otp']);

$userModel = \Models\Users::getInstance();
$userId = $userModel->getUserIdByEmail($_GET['email']);

// echo "{$data['email']}<br>{$userId}";

if($userId === null)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(new Fallacy(CustomErrors::VALUE_ERROR,CustomErrors::valueNotFoundMessage('user')));
}
$verifyStatus = $userModel->getVerifyStatus($userId);
if($verifyStatus instanceof Fallacy)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($verifyStatus);
}
// echo "verifyStatus = ".$verifyStatus.'<br>';
if($verifyStatus)
{
    \Utility\HttpUtil\sendSuccessResponse([
        "message" => "Account already verified"
    ]);
}
// exit();
$res = $userModel->verifyAccountUsingOtp($userId,$_GET['otp']);
if($res instanceof Fallacy)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($res);
}
if($res === false)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(new Fallacy(CustomErrors::SERVER_ERROR,null));
}

\Utility\HttpUtil\sendSuccessResponse();