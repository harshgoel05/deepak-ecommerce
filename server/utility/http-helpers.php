<?php
require_once(__DIR__ . '/../config/other-configs.php');

const HTTP_UNAUTHORIZED = 401;
const HTTP_OK = 200;
const HTTP_BAD_REQUEST = 400;

function unauthorizedAccessErrorHandler()
{
    http_response_code(HTTP_UNAUTHORIZED);
    $error = [
        'type' => 'UnauthorizedAccess',
        'message' => 'Not authorized to access the content'
    ];
    echo json_decode($error);
    exit();
}

function badRequestErrorHandler($errMessage = null, $errType = 'TypeError')
{
    http_response_code(HTTP_BAD_REQUEST);
    $err = [
        'type' => $errType,
        'message' => $errMessage
    ];
    echo json_decode($err);
    exit();
}
