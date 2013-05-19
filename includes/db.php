<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'detnat_boot');
define('DB_USERNAME', 'detnat_boot');
define('DB_PASSWORD', '1hostcookie23');

$odb = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
?>