<?php
namespace Utility\SessionUtil;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/config/field-consts.php');
require_once(__ROOT__.'/utility/http-error-handlers.php');
require_once(__ROOT__.'/utility/autoloader.php');

function getSessionIdentifier($loginType)
{
    startReadOnlySession();
    if ((isset($_SESSION[$loginType]) && $_SESSION[$loginType] === true) && (isset($_SESSION[SESSION_IDENTIFIER]) && !empty($_SESSION[SESSION_IDENTIFIER]))) {
        return $_SESSION[SESSION_IDENTIFIER];
    } else {
        return null;
    }
}

function ensureLoggedIn($loginType)
{
    $identifier = getSessionIdentifier($loginType);
    if($identifier === null)
    {
        \Utility\HttpErrorHandlers\unauthorizedAccessErrorHandler();
    }
}

function ensureNotLoggedIn()
{
    if(getAdminSessionIdentifier() !== null || getUserSessionIdentifier() !== null)
    {
        \Utility\HttpErrorHandlers\alreadyLoggedInErrorHandler();
    }
}

function addIdentifierToSession($loginType, $id)
{
    startSession();
    $_SESSION[SESSION_IDENTIFIER] = $id;
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
        'cookie_httponly' => 0,
        'cookie_samesite' => 'Lax',
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
        'cookie_samesite' => 'Lax'
    ]);
}

function getAdminSessionIdentifier()
{
    return getSessionIdentifier(ADMIN_LOGIN);
}

function addAdminToSession($identifier)
{
    $admin = \Models\AdminUsers::getInstance();
    $id = $admin->getId($identifier);
    return addIdentifierToSession(ADMIN_LOGIN,$id);
}

function ensureAdminLoggedIn()
{
    ensureLoggedIn(ADMIN_LOGIN);
}

function getUserSessionIdentifier()
{
    return getSessionIdentifier(USER_LOGIN);
}

function addUserToSession($identifier)
{
    $user = \Models\Users::getInstance();
    $id = $user->getId($identifier);
    return addIdentifierToSession(USER_LOGIN,$id);
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