<?php

require "../vendor/autoload.php";

$host = "127.0.0.1";
$dbname = "tst";
$username = "root";
$password = "123";

try {
    $conn = new \kfilin\pdobox\Connection($host, $dbname, $username, $password);
    $res1 = $conn->exec("CREATE TABLE aaa (fld1 smallint unsigned NOT NULL, fld2 VARCHAR(255) NOT NULL)");
    $res2 = $conn->exec("INSERT INTO aaa VALUES ( 37, 'and'), (46, 'dhgb'), (78, 'hnxa')");
    var_dump($res2);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

