<?php
namespace Models\Products;
require_once(__DIR__.'/../../config/other-configs.php');
require_once(__ROOT__ . '/utility/autoloader.php');
require_once(__ROOT__.'/config/field-consts.php');

class ProductsBase extends \Models\Table
{
    public function findByProductID($productID)
    {
        /* if(!is_numeric($productID))
        {
            return null;
        } */
        $productID = $this->dbObj->escape_string($productID);
        $temp_res =  $this->findAllExceptGivenCols(['id'],"`productid` = '{$productID}'");
        if($temp_res->num_rows > 0)
            return $temp_res->fetch_assoc();
        else 
            return null;
    }

    public function removeByProductID($productID)
    {
        $productID = $this->dbObj->escape_string($productID);
        // echo $productID.'<br>';
        $temp_res =$this->delete("`productid` = '{$productID}'");
        if(!is_string($temp_res))
        {
            if($temp_res > 0)
                return true;
            else 
                return false;
        }
        else 
            return $temp_res;
        
    }

    public function updateByProductID($productID,$row)
    {
        $productID = $this->dbObj->escape_string($productID);
        $temp_res = $this->update($row,'`'.PRODUCT_ID.'`'." = ".$productID);
        if(!is_string($temp_res))
        {
            if($temp_res > 0)
                return true;
            else 
                return false;    
        }
        else
            return $temp_res;
    }
}