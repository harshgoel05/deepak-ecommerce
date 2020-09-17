<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/models/Table.php');

$wishList = new Table;

$wishList->name = 'wish_list';
$wishList->cols = [
    'product_id' => 'INT NOT NULL',
    'user_id' => 'INT NOT NULL',
];
$wishList->extras = [
    'FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`)',
];

return $wishList;
