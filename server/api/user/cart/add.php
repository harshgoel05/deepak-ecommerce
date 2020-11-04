<?php
require_once(__DIR__ . '/../../../config/other-configs.php');
require_once(__ROOT__ . '/utility/utilities.php');
// require_once(__ROOT__.'')

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();

$data['user_id'] = \Utility\SessionUtil\getUserSessionIdentifier();

if(!array_key_exists(SELECTED_QUANTITY,$data))
{
    $data[SELECTED_QUANTITY] = 1;
}

$wagonModel = getSingleton('\\Models\\',__DIR__.'Items');

$res = $wagonModel->addItem($data);

if ($res !== true) {
    \Utility\HttpErrorHandlers\badRequestErrorHandler($res);
} else {
    \Utility\HttpUtil\sendSuccessResponse();
}
