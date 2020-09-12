<?php

function addCommonHeaders()
{
    header('Content-Type:Application/json');
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Methods: *");
    header('Access-Control-Max-Age: 86400');
}
