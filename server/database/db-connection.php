<?php
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/config/database.php');

$db = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if($db->connect_error) {
    die("Connection to the database failed : ".$db->connect_error);
}
// return true;