<?php
namespace Databases\Products;
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/databases/products/ProductsBaseDB.php');

class LeggingsDB extends ProductsBaseDB 
{
    protected function __construct()
    {
        $this->dbName = 'deepakc2';
        parent::__construct($this->dbName);
    }

}
