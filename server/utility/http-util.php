<?php
namespace Utility\HttpUtil;

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__.'/utility/http-error-handlers.php');

const HTTP_UNAUTHORIZED = 401;
const HTTP_OK = 200;
const HTTP_BAD_REQUEST = 400;

function decodeRequestJson($removeEmpty = false)
{
    $data = json_decode(file_get_contents('php://input'), true);
    if($removeEmpty && is_array($data))
    {
        $temp_data = $data;
        $data = [];
        foreach($temp_data as $key => $value)
        {
            if(empty($value) && !is_numeric($value))
            {
                continue;
            }
            $data[$key] = $value;
        }
    }
    return $data;
}

function ensureFields($data,$fields)
{
    foreach($fields as $field)
    {
        if(!array_key_exists($field,$data))
        {
            $err = new Fallacy(CustomErrors::TYPE_ERROR,CustomErrors::missingRequiredFieldMessage($field));
            \Utility\HttpErrorHandlers\badRequestErrorHandler($err);
            break;
        }
    }
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

function sendFailResponse($errMessage = null,$exitAtEnd=true)
{
    http_response_code(HTTP_OK);
    $response = [
        'success' => false
    ];
    if($errMessage !== null)
    {
        $response['error'] = [
            'message' => $errMessage
        ];
    }
    echo json_encode($response);
    if($exitAtEnd === true)
        exit();
}