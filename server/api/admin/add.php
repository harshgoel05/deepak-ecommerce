<?php

use Utility\Fallacy;

require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('POST');
$data = \Utility\HttpUtil\decodeRequestJson();

$adminUsers = \Models\AdminUsers::getInstance();

$res = $adminUsers->insertRow($data);
if($res !== true)
{
    if($res instanceof Fallacy)
        \Utility\HttpErrorHandlers\badRequestErrorHandler($res);
}
else {
    \Utility\HttpUtil\sendSuccessResponse();
}