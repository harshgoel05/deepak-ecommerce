<?php
namespace Utility\HttpUtil;

require_once(__DIR__ . '/../config/other-configs.php');

const HTTP_UNAUTHORIZED = 401;
const HTTP_OK = 200;
const HTTP_BAD_REQUEST = 400;

function decodeRequestJson()
{
    $data = json_decode(file_get_contents('php://input'), true);
    return $data;
}

function createSuccessResponse($data=null)
{
    $response = [
        'success' => true,
    ];
    if($data !== null) 
    {
        $response['data'] = $data;
    }
    return $response;
}

function sendSuccessResponse($data = null,$exitAtEnd=true)
{
    http_response_code(HTTP_OK);
    $response = createSuccessResponse($data);
    echo json_encode($response);
    if($exitAtEnd === true)
        exit();
}

function sendFailResponse($exitAtEnd=true)
{
    http_response_code(HTTP_OK);
    $response = [
        'success' => false
    ];
    echo json_encode($response);
    if($exitAtEnd === true)
        exit();
}