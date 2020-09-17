<?php
namespace Models\Products;
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/models/products/Kurtis.php');
require_once(__ROOT__.'/models/products/Leggings.php');
require_once(__ROOT__.'/models/products/Pants.php');

$productsModels['kurtis'] = Kurtis::getInstance();
$productsModels['leggings'] = Leggings::getInstance();
$productsModels['Pants'] = Pants::getInstance();

function getProductModel($productName)
{
    global $productsModels;
    if(isset($productsModels[$productName]))
        return $productsModels[$productName];
    else return null;
}