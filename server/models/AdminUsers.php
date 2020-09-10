<?php
require_once(__DIR__.'/../config/other-configs.php');
require_once(__ROOT__.'/models/Table.php');

class AdminUsers extends Table
{
    public function insertRow($row)
    {
        $row['password'] = password_hash($row['password'],PASSWORD_DEFAULT);
        return parent::insertRow($row);
    }
}