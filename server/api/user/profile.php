<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/users.php');
require_once(__ROOT__.'/utility/network-helpers.php');
require_once(__ROOT__.'/utility/error-handlers.php');

addCommonHeaders();
ensureUserLoggedIn();

$identifier = getUserSessionIdentifier();

$userProfile = $users->getProfile($identifier);

if($userProfile === false)
{
    badRequestErrorHandler(CustomErrors::VALUE_ERROR,"User not found");
}

sendSuccessResponse($userProfile);
