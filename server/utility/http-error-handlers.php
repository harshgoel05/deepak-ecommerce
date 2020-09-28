<?php

namespace Utility\HttpErrorHandlers;

use Utility\Fallacy;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/utility/http-util.php');
require_once(__ROOT__ . '/utility/CustomErrors.php');
require_once(__ROOT__.'/utility/Fallacy.php');

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

function badRequestErrorHandler(Fallacy $err, $exitAtEnd = true)
{
    http_response_code(\Utility\HttpUtil\HTTP_BAD_REQUEST);
    echo json_encode(createErrorResponse($err->getType(),$err->getMessage()));
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

function alreadyLoggedInErrorHandler($exitAtEnd = true)
{
    http_response_code(\Utility\HttpUtil\HTTP_BAD_REQUEST);
    echo json_encode(createErrorResponse(\Utility\CustomErrors::LOGIN_ERROR,\Utility\CustomErrors::ALREADY_LOGGEDIN_MESSAGE));
    if($exitAtEnd === true)
        exit();
}