<?php

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureAdminLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('GET');

$identifier = \Utility\SessionUtil\getAdminSessionIdentifier();
$adminUsers = \Models\AdminUsers::getInstance();
$adminProfile = $adminUsers->getProfile($identifier);

if($adminProfile === null)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(new Fallacy(\Utility\CustomErrors::VALUE_ERROR,CustomErrors::valueNotFoundMessage('admin user')));
}

\Utility\HttpUtil\sendSuccessResponse($adminProfile);
