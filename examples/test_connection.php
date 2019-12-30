<?php

require "../vendor/autoload.php";

$host = "127.0.0.1";
$dbname = "tst";
$username = "root";
$password = "123";

try {
    $conn = new \kfilin\pdobox\Connection($host, $dbname, $username, $password);
    var_dump($conn);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

