<?php
namespace Models\Products;
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__.'/models/Table.php');

class ProductsBase extends \Models\Table
{
    public function findByProductID($productID)
    {
        if(!is_numeric($productID))
        {
            return null;
        }
        $temp_res =  $this->findAllExceptGivenCols(['id'],"`productid` = {$productID}");
        if($temp_res->num_rows > 0)
            return $temp_res->fetch_assoc();
        else 
            return null;
    }
}