<?php
require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/database/schemas/adminUsers.php');
require_once(__ROOT__ . '/utility/network-helpers.php');



function getAdminSessionUsername()
{
    startReadOnlySession();
    $username = USER_IDENTIFIER;
    $key = 'admin-login';
    if ((isset($_SESSION['admin-login']) && $_SESSION['admin-login'] === true) && (isset($_SESSION[$username]) && !empty($_SESSION[$username]))) {
        return $_SESSION[$username];
    }
    else {
        unauthorizedAccessErrorHandler();
    }
}

function createAdminSession($username) 
{
    session_start();
    $_SESSION[USER_IDENTIFIER] = $username;
    $_SESSION['admin-login'] = true;
    return true;
}
