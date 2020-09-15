<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/users.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
// echo file_get_contents('php://input');
$data = \Utility\HttpUtil\decodeRequestJson();
// var_dump($data);
if($data[PASSWORD] !== $data['confirm_password'])
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::VALUE_ERROR,'Validation Failed');
}
$res = $users->insertRow($data);
if($res !== true)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler(\Utility\CustomErrors::TYPE_ERROR,$res);
}
else {
   \Utility\HttpUtil\sendSuccessResponse();
}