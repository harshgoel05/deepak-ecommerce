<?php

const USER_IDENTIFIER = 'email';
const ADMIN_IDENTIFIER = 'username';
const PASSWORD = 'password';
const ADMIN_LOGIN = 'admin-login';
const USER_LOGIN = 'user-login';
const PRODUCT_ID = 'productid';
const SESSION_IDENTIFIER = 'id';
const PRODUCT_CATEGORY = 'product_category';
const PRODUCT_CATEGORIES = [
    'dressMaterials',
    'ghagra',
    'kurtis',
    'leggings',
    'nightwear',
    'pants',
    'plazzos',
    'readymadeBlouse',
    'readymadeDresses',
    'sarees',
];
const PRIMARY_SELECTED_FIELDS = [
    'selected_colors',
    'selected_size',
    'selected_length',
    'selected_width'
];

const ORDER_STATUS_FLAGS =[
    "PLACED" => 0,
    "OUT_FOR_DELIVERY" => 1,
    "DELIVERED" => 2,
    "CANCELLED" => 3,
    "RETURNED" => 4
];

const ORDER_ID = 'order_id';
