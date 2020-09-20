<?php

namespace Models\Products;

require_once(__DIR__ . '/../../config/other-configs.php');
require_once(__ROOT__ . '/models/products/ProductsBase.php');
require_once(__ROOT__ . '/databases/all-databases.php');

class Sarees extends ProductsBase
{
    protected function __construct()
    {
        $_dbObj = \Databases\Products\SareesDB::getInstance();
        $_name = 'databunker';
        
        parent::__construct($_name,$_dbObj);
    }
}
