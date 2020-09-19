<?php
const DEVELOPMENT = true;
if (DEVELOPMENT === true) {
    define('DB_HOST', '162.214.80.27');
    define('DB_USERNAME', 'jewrzsmy_deepakuser');
    define('DB_PASSWORD', 'deepak@123');
} else {
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'jewrzsmy_deepakuser');
    define('DB_PASSWORD', 'deepak@123');
}
// const DB_DATABASE = 'sql12365076';
