<?php
namespace Utility\HttpErrorHandlers;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/utility/http-util.php');

function unauthorizedAccessErrorHandler($exitAtEnd = true)
{
    http_response_code(\Utility\HttpUtil\HTTP_UNAUTHORIZED);
    $error = [
        'success' => false,
        'error' => [
            'type' => 'UnauthorizedAccess',
            'message' => 'Not authorized to access the content'
        ],
    ];
    echo json_encode($error);
    if ($exitAtEnd === true)
        exit();
}

function badRequestErrorHandler($errType = null, $errMessage = null, $exitAtEnd = true)
{
    http_response_code(\Utility\HttpUtil\HTTP_BAD_REQUEST);
    $err = [
        'success' => false,
        'error' => [
            'type' => $errType,
            'message' => $errMessage
        ],
    ];
    echo json_encode($err);
    if ($exitAtEnd === true)
        exit();
}
