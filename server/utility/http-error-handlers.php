<?php
require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/utility/http-helpers.php');

function unauthorizedAccessErrorHandler()
{
    http_response_code(HTTP_UNAUTHORIZED);
    $error = [
        'type' => 'UnauthorizedAccess',
        'message' => 'Not authorized to access the content'
    ];
    echo json_encode($error);
    exit();
}

function badRequestErrorHandler($errMessage = null, $errType = 'TypeError')
{
    http_response_code(HTTP_BAD_REQUEST);
    $err = [
        'type' => $errType,
        'message' => $errMessage
    ];
    echo json_encode($err);
    exit();
}
