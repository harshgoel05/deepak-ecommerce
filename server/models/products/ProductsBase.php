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
        // print_r($productId);
        if ($productId !== null) {
            if (is_array($productId)) {
                foreach ($productId as $key => $value) {
                    $value = $this->dbObj->escape_string($value);
                    $productId[$key] = "'{$value}'";
                }
                $productsIds = implode(',', $productId);
            } else {
                $productId = "'" .$this->dbObj->escape_string($productId) . "'";
                $productsIds = $productId;
            }
            $temp_res =  $this->findAllExceptGivenCols(['id'], "`productid` in ($productsIds)");
            // echo "in not null findProductById".'<br>';
            // print_r($temp_res);
        } else {
            $temp_res = $this->findAllExceptGivenCols(['id']);
        }
        if ($temp_res->num_rows > 0) {
            /* print_r("here");
            print_r($temp_res); */
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
        $temp_res = $this->update($row, '`' . PRODUCT_ID . '`' . " = " . "'{$productId}'");
        if (!($temp_res instanceof Fallacy)) {
            if ($temp_res > 0)
                return true;
            else
                return false;
        } else
            return $temp_res;
    }

    public function findProductsByInfo($info)
    {
        $conditions = [];
        
        if(array_key_exists('colors',$info))
        {
            $condition = "";
            if(! is_array($info['colors']))
            {
                $info['colors'] = [$info['colors']];
            }
            $lastKey = array_key_last($info['colors']);
            $condition = "(";
            foreach($info['colors'] as $key => $value)
            {
                $condition.="`colors` LIKE '%{$value}%' ";
                if($key !== $lastKey)
                    $condition.="OR ";
            }
            $condition.=" ) ";
            $conditions[] = $condition;
        }

        if(array_key_exists('title',$info))
        {
            $condition = "( ";
            $condition.= "`title` LIKE '%{$info['title']}%' ";
            $condition.="OR ";
            $condition.= "`subtitle` LIKE '%{$info['title']}%' ";
            $condition.=") ";
            $conditions[] = $condition;
        }
        
        if(array_key_exists('min_price',$info))
        {
            $condition = "( ";
            $condition.="`price` BETWEEN {$info['min_price']} AND {$info['max_price']} ";
            $condition.=")";
            $conditions[]=$condition;
        }

        $condition = "";
        $lastKey = array_key_last($conditions);
        foreach($conditions as $key => $value)
        {
            $condition.=$value;
            if($key !== $lastKey)
            {
                $condition.="AND ";
            }
        }
        $temp_res = $this->findAllExceptGivenCols(['id'], $condition);
        $temp_res = $temp_res->fetch_all(MYSQLI_ASSOC);
        \Utility\ArraysUtil\addToEachRow($temp_res,PRODUCT_CATEGORY,$this->productCategory);
        return $temp_res;
    }
}
