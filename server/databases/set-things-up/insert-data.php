<?php
require_once(__DIR__ . '/../../config/other-configs.php');
require_once(__ROOT__ . '/utility/autoloader.php');

// print_r(\Models\Users::getInstance()->getCols());
// echo '<br>';
// print_r(\Models\Wishlist::getInstance()->getCols());
// echo '<br>';
// print_r(\Models\Cart::getInstance()->getCols());
// echo '<br>';
$i = 11;
foreach (PRODUCT_CATEGORIES as $category) {
    global $i;
    $productModel = getSingleton('\\Models\\Products\\', $category);
    /* $sql = "DELETE FROM databunker";
    if ($productModel->dbObj->query($sql)) {
        echo "all rows removed from " . $category . '<br>';
    } else {
        echo "removing rows with null productid failed for " . $category . '<br>';
        break;
    } */
    $num = $i * 10 + 1;
    echo "Inserting data in {$category}" . '<br>';
    $data = [
        'productid' => $category . 'PRO' . $num,
        'title' => "some {$category} product title",
        'subtitle' => "some {$category} product brand",
        'price' => $num,
        'quantity' => $num,
        'colors' => "red.green.blue",
        'fabric' => "some {$category} product fabric",
        'material' => "some {$category} product material",
        'occasion1' => 1,
        'occasion2' => 0,
        'occasion3' => 1,
        'occasion4' => 0,
        'occasion5' => 1,
        'occasion6' => 0,
        'occasion7' => 1,
        'washcare1' => 1,
        'washcare2' => 0,
        'washcare3' => 1,
        "size" => 1,
        "size1" => 1,
        "size2" => 0,
        "size3" => 0,
        "size4" => 1,
        "size5" => 0,
        "size6" => 1,
    ];

    $allGood = true;

    $temp_res = $productModel->insertRow($data);
    if ($temp_res) {
        echo "row inserted successfully" . '<br>';
    } else {
        echo "row inserting failed : " . $productModel->dbObj->error() . '<br>';
        $allGood = false;
    }
    if (!$allGood)
        break;
    $i+=10;
}
