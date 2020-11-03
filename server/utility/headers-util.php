<?php
namespace Utility\HeadersUtil;

function addCommonHeaders()
{
    if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
        $origin = $_SERVER['HTTP_ORIGIN'];
    }
    else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
        $origin = $_SERVER['HTTP_REFERER'];
    } else {
        $origin = $_SERVER['REMOTE_ADDR'];
    }

    header('Content-Type:Application/json');
    header('Cache-Control: max-age=86400');
    header('Access-Control-Allow-Origin: https://127.0.0.1:5500');
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: POST, GET, OPTIONS, DELETE");
    header('Access-Control-Max-Age: 86400');
}
