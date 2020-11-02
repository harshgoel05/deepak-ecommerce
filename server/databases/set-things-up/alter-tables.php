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
        echo "rows will null productid removed from " . $category . '<br>';
    } else {
        echo "removing rows with null productid failed for " . $category . '<br>';
        break;
    } */
    echo "Alter`ing columsn of {$category} table".'<br>';
    
    $sqls = [
        "occasion1" => "ALTER TABLE databunker MODIFY COLUMN occasion1 VARCHAR(255)",
        "occasion2" => "ALTER TABLE databunker MODIFY COLUMN occasion2 VARCHAR(255)",
        "occasion3" => "ALTER TABLE databunker MODIFY COLUMN occasion3 VARCHAR(255)",
        "occasion4" => "ALTER TABLE databunker MODIFY COLUMN occasion4 VARCHAR(255)",
        "occasion5" => "ALTER TABLE databunker MODIFY COLUMN occasion5 VARCHAR(255)",
        "occasion6" => "ALTER TABLE databunker MODIFY COLUMN occasion6 VARCHAR(255)",
        "washcare1" => "ALTER TABLE databunker MODIFY COLUMN washcare1 VARCHAR(255)",
        "washcare2" => "ALTER TABLE databunker MODIFY COLUMN washcare2 VARCHAR(255)",
        "washcare3" => "ALTER TABLE databunker MODIFY COLUMN washcare3 VARCHAR(255)",
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
