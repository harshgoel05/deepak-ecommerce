<?php

namespace Models;

use Utility\CustomErrors;
use Utility\Fallacy;

require_once(__DIR__ . '/../config/other-configs.php');
require_once(__ROOT__ . '/utility/autoloader.php');

const PRIMARY_SELECTED_FIELDS = ['selected_colors','selected_size','selected_length','selected_width'];

class Wagon extends Table
{
    public function addItem($row)
    {
        if (!(in_array($row['product_category'], PRODUCT_CATEGORIES))) {
            return new Fallacy(CustomErrors::VALUE_ERROR, CustomErrors::invalidValueMessage("product_category"));
        }
        $extra = "ON DUPLICATE KEY UPDATE `selected_quantity` = `selected_quantity` + " . $row['selected_quantity'];
        return $this->insertRow($row, $extra);
    }

    public function getItems($userId)
    {
        $condition = "`user_id` = " . $userId . ' ';
        $rows = $this->findAllExceptGivenCols(['user_id'], $condition);
        $categoryItems = [];
        while ($row = $rows->fetch_array(MYSQLI_ASSOC)) {
            $categoryItems[$row['product_category']][] = $row;
        }
        $wagonItems = [];
        $totalPrice = 0;
        foreach ($categoryItems as $category => $items) {
            /* print_r($items);
            echo '<br>'; */
            $productModel = getSingleton('\\Models\\Products\\', $category);
            $categoryItemsProIds = [];
            foreach ($items as $item) {
                $categoryItemsProIds[] = $item[PRODUCT_ID];
            }
            $tempProducts = $productModel->findProductById($categoryItemsProIds);
            $categoryProducts = [];
            if (is_array($tempProducts)) {
                foreach ($tempProducts as $product) {
                    $categoryProducts[$product[PRODUCT_ID]] = $product;
                }
                // print_r($categoryProducts);
                foreach ($items as $item) {
                    // print_r($item);
                    $productid = $item[PRODUCT_ID];
                    // print_r($productid);
                    if (!array_key_exists($productid, $categoryProducts))
                    continue;
                    // print_r($productid);
                    $temp = array_merge($categoryProducts[$productid], $item);
                    $temp[PRODUCT_CATEGORY] = $category;
                    $temp['subtotal_price'] = $temp['price'] * $temp['selected_quantity'];
                    $temp['subtotal_price'] -= ($temp['discount'] / 100) * $temp['subtotal_price'];
                    $wagonItems[] = $temp;
                }
            }
        }
        return $wagonItems;
    }

    public function removeItem($data)
    {
        foreach(PRIMARY_SELECTED_FIELDS as $field)
        {
            if(!array_key_exists($field,$data))
                $data[$field] = "0";
        }

        foreach ($data as $key => $value) {
            if(is_string($value))
                $data[$key] = $this->dbObj->escape_string($value);
        }
        $temp_data = $data;
        unset($temp_data['selected_quantity']);
        $condition = $this->conditionCreaterHelper($temp_data);
        // echo $condition.'<br>';
        $sqlRes = $this->find(['selected_quantity'], $condition);
        if ($sqlRes->num_rows > 0) {
            $qty = $sqlRes->fetch_assoc()['selected_quantity'];
            if ($data['selected_quantity'] >= $qty) {
                return $this->delete($condition);
            } else {
                $data['selected_quantity'] = min($data['selected_quantity'], $qty);
                $data['selected_quantity'] *= -1;
                return $this->addItem($data);
            }
        } else return new Fallacy(CustomErrors::VALUE_ERROR, CustomErrors::valueNotFoundMessage("product"));
    }
}
