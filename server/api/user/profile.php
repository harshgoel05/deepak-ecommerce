<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');

$identifier = \Utility\SessionUtil\getUserSessionIdentifier();
$users = \Models\Users::getInstance();
$userProfile = $users->getProfile($identifier);

if($userProfile === null)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::VALUE_ERROR,"User not found");
}

\Utility\HttpUtil\sendSuccessResponse($userProfile);
