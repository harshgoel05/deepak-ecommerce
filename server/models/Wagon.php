<?php

namespace Models;

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/utility/autoloader.php');
require_once(__ROOT__ . '/config/field-consts.php');

class Wagon extends Table
{
    public function addItem($row)
    {
        $extra = "ON DUPLICATE KEY UPDATE `quantity` = `quantity` + " . $row['quantity'];
        return $this->insertRow($row, $extra);
    }

    public function getItems($userId)
    {
        $sql = "`user_id` = " . $userId . ' ';
        $rows = $this->findAllExceptGivenCols(['user_id'], $sql);
        $items = [];
        while ($row = $rows->fetch_array(MYSQLI_ASSOC)) {
            $items[$row['product_cat']][$row['productid']] = $row['quantity'];
        }
        $wagonItems = [];
        $totalPrice = 0;
        foreach ($items as $category => $productids) {
            $productModel = getSingleton('\\Models\\Products\\', $category);
            $tempProIds = [];
            foreach ($productids as $productid => $qty) {
                $tempProIds[] = $productid;
            }
            $tempProducts = $productModel->findProductById($tempProIds);
            foreach ($tempProducts as $key => $product) {
                $tempId = $product[PRODUCT_ID];
                $qty = $items[$category][$tempId];
                $tempProducts[$key]['quantity'] = $qty;
                $tempProducts[$key]['subtotal_price'] = $tempProducts[$key]['price'] * $qty;
                $totalPrice += $tempProducts[$key]['subtotal_price'];
            }
            $wagonItems[$category] = $tempProducts;
        }
        return $wagonItems;
    }

    public function removeItem($data)
    {
        foreach($data as $key=>$value)
            $data[$key] = $this->dbObj->escape_string($value);
        $condition = "`user_id` = '{$data['user_id']}' AND `product_cat` = '{$data['product_cat']}' AND `productid` = '{$data[PRODUCT_ID]}'";
        $sqlRes = $this->find(['quantity'],$condition);
        if($sqlRes->num_rows > 0)
        {
            $qty = $sqlRes->fetch_assoc()['quantity'];
            $data['quantity'] = min($data['quantity'],$qty);
            $data['quantity']*=-1;
            return $this->addItem($data);
        }
        else return new Fallacy(CustomErrors::VALUE_ERROR,CustomErrors::valueNotFoundMessage("product"));
    }
}
