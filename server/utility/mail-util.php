<?php
namespace Utility\MailUtil;

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/utility/autoloader.php');
require_once(__ROOT__.'/config/mail.php');

function sendMail($to,$subject,$message) {
    $message = \str_replace("\n.", "\n..", $message);
    $message = \wordwrap($message,70,"\n");
    // echo "{$to}<br>{$subject}<br>{$message}";
    $success = \mail($to,$subject,$message,MAIL_ESSENTIAL_HEADERS);
    if(!$success) {
        $errMessage = error_get_last()['message'];
        return new Fallacy(CustomErrors::MAIL_ERROR,$errMessage);
    }
    return true;
}

function sendOtpMail($email,$about,$otp = null) {
    $to = $email;
    $subject = $about;
    if($otp === null)
        $otp = \rand(1000,9999);
    $message = "OTP to {$about} is {$otp}";
    $success = sendMail($to,$subject,$message);
    if($success instanceof Fallacy)
        return $success;
    return $otp;
}