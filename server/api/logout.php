<?php
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();

session_start();
session_unset();
session_destroy();

\Utility\HttpUtil\sendSuccessResponse();


