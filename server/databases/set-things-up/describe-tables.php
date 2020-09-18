<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/models/all-models.php');

echo \Models\AdminUsers::getInstance()->describe();