<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');
require_once(__ROOT__.'/models/all-models.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureRequestMethod('POST');

$data = \Utility\HttpUtil\decodeRequestJson();
// var_dump($data);
$adminUsers = \Models\AdminUsers::getInstance();
$res = $adminUsers->insertRow($data);
if($res !== true)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::TYPE_ERROR,$res);
}
else {
    \Utility\HttpUtil\sendSuccessResponse();
}