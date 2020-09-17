<?php

namespace Models\Products;

require_once(__DIR__ . '/../../config/other-configs.php');
require_once(__ROOT__ . '/models/products/ProductsBase.php');
require_once(__ROOT__ . '/databases/all-databases.php');

class Leggings extends ProductsBase
{
    protected function __construct()
    {
        $_dbObj = \Databases\Products\LeggingsDB::getInstance();
        $_name = 'databunker';
        $_cols = [
            'id',
            'productid',
            'title',
            'subtitle',
            'brand',
            'price',
            'size1',
            'size2',
            'size3',
            'size4',
            'size5',
            'size6',
            'colors',
            'image1',
            'image2',
            'image3',
            'image4',
            'image5',
            'image6',
            'description',
            'type',
            'occasion1',
            'occasion2',
            'occasion3',
            'occasion4',
            'occasion5',
            'occasion6',
            'occasion7',
            'fabric',
            'material',
            'washcare1',
            'washcare2',
            'washcare3',
        ];
        parent::__construct($_name, $_cols, $_dbObj);
    }
}
