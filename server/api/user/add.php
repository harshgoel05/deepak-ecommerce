<?php

use Utility\Fallacy;

require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');


\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();
\Utility\HttpUtil\ensureFields($data,['email',PASSWORD]);

$users = \Models\Users::getInstance();
$otp = \rand(1000,9999);
$data[USER_OTP_VERIFICATION] = $otp;
$res = $users->insertRow($data);
if($res !== true)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($res);
}

$res = \Utility\MailUtil\sendOtpMail($data['email'],'verify account',$otp);
if($res instanceof Fallacy)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($res);
}
else {
   \Utility\HttpUtil\sendSuccessResponse();
}