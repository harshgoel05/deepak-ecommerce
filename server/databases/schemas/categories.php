<?php

require_once(__DIR__."/../../config/other-configs.php");
require_once(__ROOT__.'/models/Categories.php');

$categories = new Categories;

$categories->name = 'categories';

$categories->cols = [
    'category_id' => 'INT NOT NULL PRIMARY KEY AUTO_INCREMENT',
    'title' => 'TEXT NOT NULL',
    'description' => 'TEXT',
    'created_at' => 'TIMESTAMP NOT NULL DEFAULT NOW()',
];

return $categories;