<?php
namespace Utility\SessionUtil;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/config/field-consts.php');
require_once(__ROOT__.'/utility/http-error-handlers.php');

function getSessionIdentifier($loginType,$identifierCol)
{
    startReadOnlySession();
    if ((isset($_SESSION[$loginType]) && $_SESSION[$loginType] === true) && (isset($_SESSION[$identifierCol]) && !empty($_SESSION[$identifierCol]))) {
        return $_SESSION[$identifierCol];
    } else {
        return false;
    }
}

function ensureLoggedIn($loginType,$identifierCol)
{
    $identifier = getSessionIdentifier($loginType,$identifierCol);
    if($identifier === false)
    {
        \Utility\HttpErrorHandlers\unauthorizedAccessErrorHandler();
    }
}

function addIdentifierToSession($loginType, $identifier,$identifierCol)
{
    session_start();
    $_SESSION[$identifierCol] = $identifier;
    $_SESSION[$loginType] = true;
    session_write_close();
    return true;
}

function startSession()
{
    session_start([
        'use_only_cookies' => 1,
        'cookie_lifetime' => 86400,
        'cookie_secure' => 0,
        'cookie_httponly' => 0
      ]);
}

function startReadOnlySession()
{
    session_start([
        'use_only_cookies' => 1,
        'cookie_lifetime' => 86400,
        'cookie_secure' => 0,
        'cookie_httponly' => 0,
        'read_and_close' => true,
    ]);
}

function getAdminSessionIdentifier()
{
    return getSessionIdentifier(ADMIN_LOGIN,ADMIN_IDENTIFIER);
}

function addAdminToSession($identifier)
{
    return addIdentifierToSession(ADMIN_LOGIN,$identifier,ADMIN_IDENTIFIER);
}

function ensureAdminLoggedIn()
{
    ensureLoggedIn(ADMIN_LOGIN,ADMIN_IDENTIFIER);
}

function getUserSessionIdentifier()
{
    return getSessionIdentifier(USER_LOGIN,USER_IDENTIFIER);
}

function addUserToSession($identifier)
{
    return addIdentifierToSession(USER_LOGIN,$identifier,USER_IDENTIFIER);
}

function ensureUserLoggedIn()
{
    ensureLoggedIn(USER_LOGIN,USER_IDENTIFIER);
}

function ensureRequestMethod($method)
{
    $method = strtoupper($method);
    if($_SERVER['REQUEST_METHOD'] !== $method)
    {
        \Utility\HttpErrorHandlers\wrongRequestMethodErrorHandler();
    }
}