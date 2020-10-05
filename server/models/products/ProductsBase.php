<?php

namespace Models\Products;

use Utility\Fallacy;

require_once(__DIR__ . '/../../config/other-configs.php');
require_once(__ROOT__ . '/utility/autoloader.php');
require_once(__ROOT__ . '/config/field-consts.php');

class ProductsBase extends \Models\Table
{
    protected $productCategory;
    public function findProductById($productId = null)
    {
        /* if(!is_numeric($productId))
        {
            return null;
        } */
        if ($productId !== null) {
            if (is_array($productId)) {
                foreach ($productId as $key => $value) {
                    $value = $this->dbObj->escape_string($value);
                    $productId[$key] = "'{$value}'";
                }
                $productsIds = implode(',', $productId);
            } else {
                $productId = $this->dbObj->escape_string($productId);
                $productsIds = $productId;
            }
            $temp_res =  $this->findAllExceptGivenCols(['id'], "`productid` in ($productsIds)");
        } else {
            $temp_res = $this->findAllExceptGivenCols(['id']);
        }
        if ($temp_res->num_rows > 0) {
            if ($productId === null || is_array($productId))
                return $temp_res->fetch_all(MYSQLI_ASSOC);
            else return $temp_res->fetch_assoc();
        } else
        {
            if ($productId === null || is_array($productId))
                return [];
            else return null;
        }
    }

    public function removeProductById($productId)
    {
        $productId = $this->dbObj->escape_string($productId);
        // echo $productId.'<br>';
        $temp_res = $this->delete("`productid` = '{$productId}'");
        if (!($temp_res instanceof Fallacy)) {
            if ($temp_res > 0)
                return true;
            else
                return false;
        } else
            return $temp_res;
    }

    public function updateProductById($productId, $row)
    {
        $productId = $this->dbObj->escape_string($productId);
        $temp_res = $this->update($row, '`' . PRODUCT_ID . '`' . " = " . $productId);
        if (!($temp_res instanceof Fallacy)) {
            if ($temp_res > 0)
                return true;
            else
                return false;
        } else
            return $temp_res;
    }

    public function findProductsByInfo($info, $findIn = ['title', 'subtitle'], $conditionSep = "OR")
    {
        $condition = "";
        $temp_arr = array_keys($findIn);
        $lastKey = end($temp_arr);
        foreach ($findIn as $key => $colName) {
            $condition .= "`{$colName}` LIKE '%${info}%' ";
            if ($key != $lastKey) {
                $condition .= "{$conditionSep} ";
            }
        }
        $temp_res = $this->findAllExceptGivenCols(['id'], $condition);
        $temp_res = $temp_res->fetch_all(MYSQLI_ASSOC);
        \Utility\ArraysUtil\addToEachRow($temp_res,PRODUCT_CATEGORY,$this->productCategory);
        return $temp_res;
    }
}
