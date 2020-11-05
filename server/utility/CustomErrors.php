<?php
namespace Utility;

require_once(__DIR__.'/../config/other-configs.php');

abstract class CustomErrors 
{
    const TYPE_ERROR = 'TypeError';
    const VALUE_ERROR = 'ValueError';
    const AUTH_ERROR = 'AuthenticationError';
    const UNAUTHORIZED_ACCESS_ERROR = 'UnauthorizedAccessError';
    const WRONG_REQUEST_METHOD_ERROR = 'WrongRequestMethodError';
    const LOGIN_ERROR = 'LoginError';
    const MAIL_ERROR = 'MailError';
    const SERVER_ERROR = 'ServerError';

    public static function invalidValueMessage($val)
    {
        return "Invalid {$val}";
    }

    public static function valueNotFoundMessage($val)
    {
        return "{$val} not found";
    }

    public static function validationFailedMessage($val)
    {
        return "{$val} validation failed";
    }

    public static function notAvailableMessage($val)
    {
        return "{$val} not available";
    }

    public static function missingRequiredFieldMessage($val)
    {
        return "Missing required field '{$val}' in request";
    }

    const ALREADY_LOGGEDIN_MESSAGE = 'Already logged in';
}
