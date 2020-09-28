<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');


\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();

$users = \Models\Users::getInstance();

$res = $users->insertRow($data);
if($res !== true)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($res);
}
else {
   \Utility\HttpUtil\sendSuccessResponse();
}