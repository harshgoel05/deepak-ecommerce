<?php
namespace Models\Products;
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/models/products/Kurtis.php');
require_once(__ROOT__.'/models/products/Leggings.php');
require_once(__ROOT__.'/models/products/Pants.php');
require_once(__ROOT__.'/models/products/Plazzos.php');
require_once(__ROOT__.'/models/products/DressMaterials.php');
require_once(__ROOT__.'/models/products/Sarees.php');
require_once(__ROOT__.'/models/products/Ghagra.php');
require_once(__ROOT__.'/models/products/ReadymadeDresses.php');
require_once(__ROOT__.'/models/products/ReadymadeBlouse.php');
require_once(__ROOT__.'/models/products/Nightwear.php');

$productsModels['kurtis'] = Kurtis::getInstance();
$productsModels['leggings'] = Leggings::getInstance();
$productsModels['Pants'] = Pants::getInstance();
$productModels['plazzos'] = Plazzos::getInstance();
$productModels['dressMaterials'] = DressMaterials::getInstance();
$productModels['sarees'] = Sarees::getInstance();
$productModels['ghagra'] = Ghagra::getInstance();
$productModels['readymadeDresses'] = ReadymadeDresses::getInstance();
$productModels['readymadeBlouse'] = ReadymadeBlouse::getInstance();
$productModels['nightwear'] = Nightwear::getInstance();

function getProductModel($productName)
{
    global $productsModels;
    if(isset($productsModels[$productName]))
        return $productsModels[$productName];
    else return null;
}