<?php

namespace Models;

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/utility/autoloader.php');

class OrdersDetails extends Table
{
    protected function addKeysIfMissing(&$row)
    {
        if(!array_key_exists('discount',$row))
            $row['discount'] = 0;
    }
    protected function __construct()
    {
        $_dbObj = \Databases\UsersDB::getInstance();
        $_name = 'orders_details';
        parent::__construct($_name, $_dbObj);
    }

    public function insertRow($data,$extra=NULL)
    {
        /* print_r($data);
        echo '<br>'; */

        if (!(in_array($data[PRODUCT_CATEGORY], PRODUCT_CATEGORIES))) {
            return new Fallacy(CustomErrors::VALUE_ERROR, CustomErrors::invalidValueMessage(PRODUCT_CATEGORY." {$data[PRODUCT_CATEGORY]}"));
        }
        $productModel = getSingleton('\\Models\\Products\\', $data['product_category']);
        $product = $productModel->findProductById($data['productid']);
        if ($product === null) {
            return new Fallacy(CustomErrors::VALUE_ERROR, CustomErrors::valueNotFoundMessage("product with productid " . $data['productid']));
        }
        // print_r($product);
        // echo '<br>';
        if($product['quantity'] < $data['selected_quantity'])
        {
            /* print_r($data['selected_quantity']);
            echo '<br>';
            print_r($product['quantity']);
            echo '<br>'; */
            return new Fallacy(CustomErrors::VALUE_ERROR,CustomErrors::notAvailableMessage("required number of products with productid {$product['productid']}"));
        }
        $this->addKeysIfMissing($data);
        $data['price'] = $product['price'];
        $data['subtotal_price'] = $product['price'] * $data['selected_quantity'];
        $data['subtotal_price'] -= ($data['discount'] / 100) * $data['subtotal_price'];
        $productUpdationRow = [];
        $productUpdationRow['quantity']=$product['quantity']-$data['selected_quantity'];
        $temp_res = $productModel->updateProductById($product['productid'],$productUpdationRow);
        if($temp_res instanceof Fallacy)
            return $temp_res;
        return parent::insertRow($data);
    }
}
