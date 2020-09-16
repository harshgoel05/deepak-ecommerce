<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/models/AdminUsers.php');

$adminUsers = new \Models\AdminUsers;

$adminUsers->name = 'admin_users';
$adminUsers->cols = [
    'admin_id' => 'INT NOT NULL PRIMARY KEY AUTO_INCREMENT',
    'username' => 'VARCHAR(255) NOT NULL UNIQUE',
    'password' => 'VARCHAR(255) NOT NULL',
    'email' => 'VARCHAR(255) NOT NULL UNIQUE',
    'created_at' => 'TIMESTAMP NOT NULL DEFAULT NOW()',
];

return $adminUsers;