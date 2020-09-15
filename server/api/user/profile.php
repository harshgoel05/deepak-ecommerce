<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/users.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();

$identifier = \Utility\SessionUtil\getUserSessionIdentifier();

$userProfile = $users->getProfile($identifier);

if($userProfile === false)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::VALUE_ERROR,"User not found");
}

\Utility\HttpUtil\sendSuccessResponse($userProfile);
