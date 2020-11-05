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
    "RETURNED" => 4,
    'ABORTED' => 5,
    'FAILED' => 6
];

const ORDER_ID = 'order_id';
const COUPON_CODE = 'coupon_code';
const MINIMUM_AMOUNT_NEEDED = 'min_amount_needed';
const SUBTOTAL_PRICE = 'subtotal_price';
const FINAL_SUBTOTAL_PRICE = 'final_subtotal_price';
const FLAT_OFF_AMOUNT = 'flat_off_amount';
const FLAT_OFF_PERCENTAGE = 'flat_off_percentage';
const COUPON = 'coupon';
const TOTAL_AMOUNT = 'total_amount';
const FINAL_AMOUNT = 'final_amount';
const ORDER_STATUS = 'order_status';
const SELECTED_QUANTITY = 'selected_quantity';

const USER_EMAIL = 'email';
const USER_OTP_RESET = 'otp_reset';
const USER_OTP_VERIFICATION = 'otp_verification';
const USER_VERIFIED = 'verified';

const FILTER_MIN_PRICE = 'min_price';
const FILTER_MAX_PRICE = 'max_price';