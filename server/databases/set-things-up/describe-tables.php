<?php
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/models/all-models.php');

\Models\AdminUsers::getInstance()->describe();
\Models\Products\Sarees::getInstance()->describe();
\Models\Products\Plazzos::getInstance()->describe();
\Models\Products\Leggings::getInstance()->describe();