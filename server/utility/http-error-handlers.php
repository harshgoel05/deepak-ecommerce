<?php

namespace Utility\HttpErrorHandlers;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/utility/http-util.php');
require_once(__ROOT__ . '/utility/CustomErrors.php');

function createErrorResponse($errType = null, $errMessage = null)
{
    $err = [
        'success' => false,
        'error' => [
            'type' => $errType,
            'message' => $errMessage,
        ]
    ];
    return $err;
}

function unauthorizedAccessErrorHandler($exitAtEnd = true)
{
    http_response_code(\Utility\HttpUtil\HTTP_UNAUTHORIZED);
    echo json_encode(createErrorResponse(\Utility\CustomErrors::UNAUTHORIZED_ACCESS_ERROR, 'Not authorized to access the content'));
    if ($exitAtEnd === true)
        exit();
}

function badRequestErrorHandler($errType = null, $errMessage = null, $exitAtEnd = true)
{
    http_response_code(\Utility\HttpUtil\HTTP_BAD_REQUEST);
    echo json_encode(createErrorResponse($errType,$errMessage));
    if ($exitAtEnd === true)
        exit();
}

function wrongRequestMethodErrorHandler($exitAtEnd = true)
{
    http_response_code(\Utility\HttpUtil\HTTP_BAD_REQUEST);
    echo json_encode(createErrorResponse(\Utility\CustomErrors::WRONG_REQUEST_METHOD_ERROR,"Try different http method to access the content properly"));
    if($exitAtEnd === true)
        exit();
}