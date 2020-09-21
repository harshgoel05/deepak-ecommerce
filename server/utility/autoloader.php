<?php
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/utility/arrays-util.php');

spl_autoload_register(function ($class) {

    $path_arr = explode('\\',$class);
    $len = count($path_arr);
    if ($len === 1) {
        return;
    }
    $file = __ROOT__.'/';
    for($i=0;$i<$len-1;$i++)
    {
        // echo $path_arr[$i].'<br>';
        $path_arr[$i] = lcfirst($path_arr[$i]);
        // echo $path_arr[$i].'<br>';
        $file.=$path_arr[$i].'/';
        // echo $file.'<br>';
    }

    $file.=$path_arr[$len-1].'.php';
    // echo $file.'<br>';
    // if the file exists, require it
    if (file_exists($file)) {
        // echo "Required {$file}";
        require $file;
    }
    else {
        throw new Exception("Autoloading failed for {$file}");
    }
});

function getSingleton($namespacePrefix,$dirName)
{
    $relDirName = \Utility\ArraysUtil\getLastExplodedElem('/',$dirName);
    $className = $namespacePrefix.ucfirst($relDirName);
    return $className::getInstance();
}