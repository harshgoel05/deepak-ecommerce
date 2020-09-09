<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/Table.php');

$usersTable = new Table;

$usersTable->name = 'users';
$usersTable->cols = [
    'id' => 'INT NOT NULL PRIMARY KEY AUTO_INCREMENT',
    'username' => 'VARCHAR(255) NOT NULL',
    'password' => 'VARCHAR(255) NOT NULL',
    'email' => 'VARCHAR(255) NOT NULL',
    'created_at' => 'TIMESTAMP NOT NULL DEFAULT NOW()',
];

return $usersTable;