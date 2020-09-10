<?php
require_once(__DIR__ . '/../config/other-configs.php');

const HTTP_UNAUTHORIZED = 401;
const HTTP_OK = 200;
const HTTP_BAD_REQUEST = 400;

function decodeRequestJson()
{
    $data = json_decode(file_get_contents('php://input'),true);
    return $data;
}