<?php
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/utility/network-helpers.php');

addCommonHeaders();

session_unset();
session_destroy();

sendSuccessResponse();


