<?php 
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/models/Products.php');
require_once(__ROOT__.'/database/schemas/categories.php');

$products = new Products;

$products->name = 'products';
$products->cols = [
    'id' => 'INT NOT NULL PRIMARY KEY AUTO_INCREMENT',
    'category_id' => 'INT NOT NULL',
    'product_id' => 'INT NOT NULL',
    'title' => 'TEXT NOT NULL',
    'subtitle' => 'TEXT',
    'description' => "TEXT NOT NULL",
    'stock' => 'INT NOT NULL DEFAULT 0',
    'price' => 'DOUBLE NOT NULL DEFAULT 0.00',
    'created_at' => 'TIMESTAMP NOT NULL DEFAULT NOW()',
];

$products->extras = [
    "FOREIGN KEY (category_id) REFERENCES {$categories->name}(id) ON DELETE CASCADE ",
];

return $products;
