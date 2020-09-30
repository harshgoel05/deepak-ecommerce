<?php

namespace Models\Products;

require_once(__DIR__ . '/../../config/other-configs.php');
require_once(__ROOT__ . '/models/products/ProductsBase.php');
require_once(__ROOT__ . '/utility/autoloader.php');

class Sarees extends ProductsBase
{
    protected function __construct()
    {
        $_dbObj = \Databases\Products\SareesDB::getInstance();
        $_name = 'databunker';
        $this->productCategory = 'sarees';
        parent::__construct($_name,$_dbObj);
    }
}
