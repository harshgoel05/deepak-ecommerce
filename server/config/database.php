<?php
const DEVELOPMENT = false;
if (DEVELOPMENT === true) {
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'parth_07');
    define('DB_PASSWORD', 'abcdefg');
} else {
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'wmctest@testing1.thestrategybook.com');
    define('DB_PASSWORD', 'wmctest@123');
}
// const DB_DATABASE = 'sql12365076';
