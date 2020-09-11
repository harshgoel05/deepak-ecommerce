<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/models/Users.php');

$users = new Users;

$users->name = 'users';
$users->cols = [
    'user_id' => 'INT NOT NULL PRIMARY KEY AUTO_INCREMENT',
    'username' => 'VARCHAR(255) NOT NULL UNIQUE',
    'password' => 'VARCHAR(255) NOT NULL',
    'email' => 'VARCHAR(255) NOT NULL UNIQUE',
    'phone_number' => 'VARCHAR(30)',
    'created_at' => 'TIMESTAMP NOT NULL DEFAULT NOW()',
];

return $users;