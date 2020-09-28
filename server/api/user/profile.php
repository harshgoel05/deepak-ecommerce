<?php

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('GET');

$identifier = \Utility\SessionUtil\getUserSessionIdentifier();
$users = \Models\Users::getInstance();
$userProfile = $users->getProfile($identifier);

if($userProfile === null)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(new Fallacy(CustomErrors::VALUE_ERROR,CustomErrors::valueNotFoundMessage('user')));
}

\Utility\HttpUtil\sendSuccessResponse($userProfile);
