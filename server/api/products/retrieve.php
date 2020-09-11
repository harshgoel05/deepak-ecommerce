<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/products.php');
require_once(__ROOT__.'/utility/headers-helpers.php');

addCommonHeaders();

if(array_key_exists('id',$_get))
{
    $res = $products->findById(NULL,$_get['id']);
    if($res !== false)
        sendSuccessResponse($res);
}

if(array_key_exists('title',$_get))
{ 
    
}

sendSuccessResponse([]);