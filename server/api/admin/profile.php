<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/adminUsers.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureAdminLoggedIn();

$identifier = \Utility\SessionUtil\getAdminSessionIdentifier();

$adminProfile = $adminUsers->getProfile($identifier);

if($adminProfile === false)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::VALUE_ERROR,"Admin user not found");
}

\Utility\HttpUtil\sendSuccessResponse($adminProfile);
