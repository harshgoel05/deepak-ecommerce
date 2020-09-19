<?php
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

$data = \Utility\HttpUtil\decodeRequestJson();
echo file_get_contents($data['image']);