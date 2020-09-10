<?php
require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/utility/network-helpers.php');
require_once(__ROOT__ . '/config/field-consts.php');
require_once(__ROOT__.'/utility/http-error-handlers.php');

function getSessionIdentifier($loginType)
{
    startReadOnlySession();
    if ((isset($_SESSION[$loginType]) && $_SESSION[$loginType] === true) && (isset($_SESSION[USER_IDENTIFIER]) && !empty($_SESSION[USER_IDENTIFIER]))) {
        return $_SESSION[USER_IDENTIFIER];
    } else {
        return false;
    }
}

function ensureLoggedIn($loginType)
{
    $identifier = getSessionIdentifier($loginType);
    if($identifier === false)
    {
        unauthorizedAccessErrorHandler();
    }
}

function addIdentifierToSession($loginType, $identifier)
{
    session_start();
    $_SESSION[USER_IDENTIFIER] = $identifier;
    $_SESSION[$loginType] = true;
    session_write_close();
    return true;
}

function startReadOnlySession()
{
    session_start();
    session_write_close();
}

function getAdminSessionIdentifier()
{
    return getSessionIdentifier(ADMIN_LOGIN);
}

function addAdminToSession($identifier)
{
    return addIdentifierToSession(ADMIN_LOGIN,$identifier);
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
    return addIdentifierToSession(USER_LOGIN,$identifier);
}

function ensureUserLoggedIn()
{
    ensureLoggedIn(USER_LOGIN);
}