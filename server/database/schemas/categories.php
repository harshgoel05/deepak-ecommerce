<?php

require_once(__DIR__."/../../config/other-configs.php");
require_once(__ROOT__.'/database/Table.php');

$categoriesTable = new Table;

$categoriesTable->name = 'categories';

$categoriesTable->cols = [
    'id' => 'INT NOT NULL PRIMARY KEY AUTO_INCREMENT',
    'title' => 'TEXT NOT NULL',
    'description' => 'TEXT',
    'created_at' => 'TIMESTAMP NOT NULL DEFAULT NOW()',
];

return $categoriesTable;