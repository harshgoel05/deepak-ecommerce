<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/utility/autoloader.php');

// print_r(\Models\Users::getInstance()->getCols());
// echo '<br>';
// print_r(\Models\Wishlist::getInstance()->getCols());
// echo '<br>';
// print_r(\Models\Cart::getInstance()->getCols());
// echo '<br>';
$users = \Models\Users::getInstance();
$fields = $users->getCols();
foreach($fields as $colName)
{
    echo $colName.'<br>';
}