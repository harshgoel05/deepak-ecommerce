<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/models/all-models.php');

print_r(\Models\AdminUsers::getInstance()->getCols());
echo '<br>';
print_r(\Models\Products\Sarees::getInstance()->getCols());
echo '<br>';
print_r(\Models\Products\Plazzos::getInstance()->getCols());
echo '<br>';
print_r(\Models\Products\Leggings::getInstance()->getCols());
echo '<br>';