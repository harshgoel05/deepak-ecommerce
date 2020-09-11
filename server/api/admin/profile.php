<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/adminUsers.php');
require_once(__ROOT__.'/utility/network-helpers.php');
require_once(__ROOT__.'/utility/error-handlers.php');

addCommonHeaders();
ensureAdminLoggedIn();

$identifier = getAdminSessionIdentifier();

$adminProfile = $adminUsers->getProfile($identifier);

if($adminProfile === false)
{
    badRequestErrorHandler(CustomErrors::VALUE_ERROR,"Admin user not found");
}

sendSuccessResponse($adminProfile);
