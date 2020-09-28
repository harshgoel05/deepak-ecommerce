<?php
require_once(__DIR__ . '/../../../config/other-configs.php');
require_once(__ROOT__ . '/utility/utilities.php');
// require_once(__ROOT__.'')

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();

$data['user_id'] = \Utility\SessionUtil\getUserSessionIdentifier();

$wagonModel = getSingleton('\\Models\\',__DIR__);

$res = $wagonModel->addItem($data);

if ($res !== true) {
    \Utility\HttpErrorHandlers\badRequestErrorHandler($res);
} else {
    \Utility\HttpUtil\sendSuccessResponse();
}
