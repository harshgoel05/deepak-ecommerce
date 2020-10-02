<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/autoloader.php');

// print_r(\Models\Users::getInstance()->getCols());
// echo '<br>';
// print_r(\Models\Wishlist::getInstance()->getCols());
// echo '<br>';
// print_r(\Models\Cart::getInstance()->getCols());
// echo '<br>';
foreach(PRODUCT_CATEGORIES as $category)
{
    $productModel = getSingleton('\\Models\\Products\\',$category);
    $sql = "ALTER TABLE databunker ADD quantity INT NOT NULL DEFAULT 0";
    if($productModel->dbObj->query($sql))
    {
        echo "column added in ".$category.'<br>';
    }
    else 
    {
        echo "task failed for table ".$category.'<br>';
    }
}