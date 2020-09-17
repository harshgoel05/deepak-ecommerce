<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/models/Table.php');
 
$orders = new Table;

$orders->name = 'orders';
$orders->cols = [
    'order_id' => 'INT NOT NULL PRIMARY KEY AUTO_INCREMENT',
    'user_id' => 'INT NOT NULL',
    'product_id' => 'INT NOT NULL',
    'payment_id' => 'INT NOT NULL',
    'order_date' => 'TIMESTAMP NOT NULL DEFAULT NOW()',
];

$orders->extras = [
    'FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`)',
    'FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`)',
];