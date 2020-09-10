<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/products.php');

$product;
$status_code = 200;
if(array_key_exists('id',$_get))
{
    $res = $products->findById(NULL,$_get['id']);
    if($res->num_rows > 0)
        $product = $res->fetch_assoc();
}

http_response_code($status_code);
echo json_encode($product);