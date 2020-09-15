<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/adminUsers.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
// echo file_get_contents('php://input');
$data = \Utility\HttpUtil\decodeRequestJson();
// var_dump($data);
$res = $adminUsers->insertRow($data);
if($res !== true)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::TYPE_ERROR,$res);
}
else {
    \Utility\HttpUtil\sendSuccessResponse();
}