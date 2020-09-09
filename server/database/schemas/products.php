<?php 
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/Table.php');
require_once(__ROOT__.'/database/schemas/categories.php');

$productsTable = new Table;

$productsTable->name = 'products';
$productsTable->cols = [
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

$productsTable->extras = [
    "FOREIGN KEY (category_id) REFERENCES {$categoriesTable->name}(id) ON DELETE CASCADE ",
];

return $productsTable;
