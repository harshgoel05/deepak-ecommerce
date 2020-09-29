<?php

use Utility\CustomErrors;

require_once __DIR__ . '/../../config/other-configs.php';
require_once __ROOT__ . '/utility/utilities.php';

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();

$identifier = \Utility\SessionUtil\getUserSessionIdentifier();

$user = \Models\Users::getInstance();
$temp_res = $user->updateProfile($identifier, $data);

if ($temp_res === true) {
    \Utility\HttpUtil\sendSuccessResponse();
} else if ($temp_res === false) {
    \Utility\HttpUtil\sendFailResponse(CustomErrors::valueNotFoundMessage('user'));
} else {
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
}
