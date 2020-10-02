<?php

namespace Models;

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/utility/autoloader.php');

class OrdersDetails extends Table
{
    protected function __construct()
    {
        $_dbObj = \Databases\UsersDB::getInstance();
        $_name = 'orders_details';
        parent::__construct($_name, $_dbObj);
    }

    public function insertRow($data)
    {
        if (!(in_array($data['product_category'], PRODUCT_CATEGORIES))) {
            return new Fallacy(CustomErrors::VALUE_ERROR, CustomErrors::invalidValueMessage('product_category'));
        }
        $productModel = getSingleton('\\Models\\Products\\', $data['product_category']);
        $product = $productModel->findProductById($data['productid']);
        if ($product === null) {
            return new Fallacy(CustomErrors::VALUE_ERROR, CustomErrors::valueNotFoundMessage("product with productid " . $data['productid']));
        }
        $data['price'] = $product['price'];
        $data['subtotal_price'] = $product['price'] * $data['quantity'];
        $data['subtotal_price'] -= ($data['discount'] / 100) * $data['subtotal_price'];
        return $this->insertRow($data);
    }
}
