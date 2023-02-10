<?php 
    define('DB_HOST', 'localhost');
    define('DB_USER', 'syazmie');
    define('DB_PASS', '1234');
    define('DB_NAME', 'php_dev');


    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if($conn ->connect_error) {
        die('connection Failed' . $conn->connect_error);
    }

?>