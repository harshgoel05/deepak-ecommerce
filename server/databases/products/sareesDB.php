<?php
namespace Databases\Products;
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/databases/products/ProductsBaseDB.php');

class SareesDB extends ProductsBaseDB 
{
    protected function __construct()
    {
        $this->dbName = 'deepakc6';
        parent::__construct($this->dbName);
    }

}
