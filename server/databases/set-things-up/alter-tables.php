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
    /* $sql = "DELETE FROM databunker";
    if ($productModel->dbObj->query($sql)) {
        echo "all rows removed from " . $category . '<br>';
    } else {
        echo "removing rows failed for " . $category . '<br>';
        break;
    } */
    echo "Altering columsn of {$category} table".'<br>';
    
    $sqls = [
        "image1" => "ALTER TABLE databunker MODIFY COLUMN image1 MEDIUMBLOB",
        "image2" => "ALTER TABLE databunker MODIFY COLUMN image2 MEDIUMBLOB",
        "image3" => "ALTER TABLE databunker MODIFY COLUMN image3 MEDIUMBLOB",
        "image4" => "ALTER TABLE databunker MODIFY COLUMN image4 MEDIUMBLOB",
        "image5" => "ALTER TABLE databunker MODIFY COLUMN image5 MEDIUMBLOB",
        "image6" => "ALTER TABLE databunker MODIFY COLUMN image6 MEDIUMBLOB",
    ];
    $allGood = true;
    foreach ($sqls as $key => $value) {
        if(!in_array($key,$productModel->cols,true))
            continue;
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
