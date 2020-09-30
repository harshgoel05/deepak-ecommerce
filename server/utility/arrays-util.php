<?php
namespace Utility\ArraysUtil;
require_once(__DIR__.'/../config/other-configs.php');

function getLastExplodedElem($sep,$twine)
{
    $temp = explode($sep,$twine);
    $len = count($temp);
    return $temp[$len-1];
}

function addToEachRow(&$arr,$key,$value)
{
    foreach($arr as &$val)
    {
        $val[$key] = $value;
    }
}