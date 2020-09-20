<?php
namespace Utility\ArraysUtil;
require_once(__DIR__.'/../config/other-configs.php');

function getLastExplodedElem($sep,$twine)
{
    $temp = explode($sep,$twine);
    $len = count($temp);
    return $temp[$len-1];
}