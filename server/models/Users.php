<?php
namespace Models;

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/models/Table.php');
require_once(__ROOT__.'/config/field-consts.php');
require_once(__ROOT__ . '/utility/autoloader.php');
require_once(__ROOT__.'/utility/Fallacy.php');

class Users extends Identifier
{
    protected function __construct()
    {
        $this->identifierCol = USER_IDENTIFIER;
        $_dbObj = \Databases\UsersDB::getInstance();
        $_name = 'cred';
        parent::__construct($_name,$_dbObj);
    }

    public function getEmail($userId) {
        $rows = $this->find([USER_EMAIL],"`id` = {$userId}");
        if($rows->num_rows > 0) {
            $row = $rows->fetch_assoc();
            return $row[USER_EMAIL];
        }        
        else return null;
    }

    public function getUserIdByEmail($email) {
        // print($email);
        $rows = $this->find(['id'],"`".USER_EMAIL."`"." = '{$email}'");
        if($rows->num_rows > 0) {
            $row = $rows->fetch_assoc();
            return $row['id'];
        }        
        else return null;
    }

    public function setResetPasswordOTP($userId)
    {
        $email = $this->getEmail($userId);
        if($email === null) {
            return new Fallacy(CustomErrors::AUTH_ERROR,CustomErrors::valueNotFoundMessage('user'));
        }
        $otp = \Utility\MailUtil\sendOtpMail($email,'Reset Password');
        if($otp instanceof Fallacy)
            return $otp;
        $res = $this->update([USER_OTP_RESET => $otp],$this->conditionCreaterHelper(['id' => $userId]));
        if($res instanceof Fallacy)
            return $res;
        if($res > 0)
            return true;
        else  return false;
    }

    public function ResetPasswordUsingOtp($userId,$otp,$newPassword)
    {
        $row = $this->find([USER_OTP_RESET],$this->conditionCreaterHelper(['id' => $userId]));
        if($row->num_rows === 0)
        {
            return new Fallacy(CustomErrors::AUTH_ERROR,CustomErrors::valueNotFoundMessage('user'));
        }
        $row = $row->fetch_assoc();
        $verify = ($otp == $row[USER_OTP_RESET]);
        // echo $otp.'<br>'.$row[USER_OTP_RESET].'<br>';
        if(!$verify)
        {
            return new Fallacy(CustomErrors::VALUE_ERROR,"incorrect otp");
        }
        $res = $this->updateProfile($userId,[PASSWORD => $newPassword]);
        if($res instanceof Fallacy)
        {
            return $res;
        }
        return $res;
    }

    public function verifyAccountUsingOtp($userId,$otp) {
        $row = $this->find([USER_OTP_VERIFICATION],$this->conditionCreaterHelper(['id' => $userId]));
        if($row->num_rows === 0)
        {
            return new Fallacy(CustomErrors::AUTH_ERROR,CustomErrors::valueNotFoundMessage('user'));
        }
        $row = $row->fetch_assoc();
        $verify = ($otp == $row[USER_OTP_VERIFICATION]);
        // echo $otp.'<br>'.$row[USER_OTP_VERIFICATION].'<br>';
        if(!$verify)
        {
            return new Fallacy(CustomErrors::VALUE_ERROR,"incorrect otp");
        }
        $res = $this->updateProfile($userId,[USER_VERIFIED => 1]);
        if($res instanceof Fallacy)
        {
            return $res;
        }
        return $res;
    }

    public function getVerifyStatus($userId)
    {
        $row = $this->findById([USER_VERIFIED],$userId);
        if($row instanceof Fallacy)
        {
            return $row;
        }
        if($row === null)
        {
            return new Fallacy(CustomErrors::AUTH_ERROR,CustomErrors::valueNotFoundMessage('user'));
        }
        return $row[USER_VERIFIED];
    }
}
