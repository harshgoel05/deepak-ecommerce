<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/database/schemas/categories.php');
require_once(__ROOT__ . '/database/schemas/products.php');
require_once(__ROOT__.'/database/schemas/users.php');
require_once(__ROOT__.'/database/schemas/adminUsers.php');

$tables = [
    $categories,
    $products,
    $users,
    $adminUsers
];

foreach ($tables as $table) {
    $result = $table->create();
    if ($result === true) {
        echo "{$table->name} table created successfully";
    } else {
        echo "Unable to create {$table->name} table : " . $result;
    }
    echo '<br>';
}
