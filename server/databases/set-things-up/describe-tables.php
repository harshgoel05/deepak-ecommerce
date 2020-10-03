<?php
require_once(__DIR__ . '/../../config/other-configs.php');
require_once(__ROOT__ . '/utility/autoloader.php');

// print_r(\Models\Users::getInstance()->getCols());
// echo '<br>';
// print_r(\Models\Wishlist::getInstance()->getCols());
// echo '<br>';
// print_r(\Models\Cart::getInstance()->getCols());
// echo '<br>';
foreach (PRODUCT_CATEGORIES as $category) {
    $productModel = getSingleton('\\Models\\Products\\', $category);
    $sql = "DELETE FROM databunker";
    if ($productModel->dbObj->query($sql)) {
        echo "rows will null productid removed from " . $category . '<br>';
    } else {
        echo "removing rows with null productid failed for " . $category . '<br>';
        break;
    }
    $sqls = [
        "ALTER TABLE databunker MODIFY COLUMN `productid` VARCHAR(255) NOT NULL UNIQUE",
        "ALTER TABLE databunker MODIFY COLUMN `title` VARCHAR(255) NOT NULL",
        "ALTER TABLE databunker MODIFY COLUMN `price` FLOAT NOT NULL"
    ];
    $allGood = true;
    foreach ($sqls as $key => $value) {
        $temp_res = $productModel->dbObj->query($value);
        if ($temp_res) {
            echo "ALTER {$key} successful" . '<br>';
        } else {
            echo "ALTER {$key} failed : ".$productModel->dbObj->error() . '<br>';
            $allGood = false;
            break;
        }
    }
    if (!$allGood)
        break;
}
