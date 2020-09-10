<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/adminUsers.php');
require_once(__ROOT__.'/utility/http-helpers.php');

$res = $adminUsers->insertRow(json_decode($_POST));
if($res !== true)
{
    badRequestErrorHandler($res);
}
else {
    echo json_encode([
        'success' => true,
    ]);
}