<?php

require "../vendor/autoload.php";

$host = "127.0.0.1";
$dbname = "ecofenster";
$username = "root";
$password = "123";

try {
    $conn = new \kfilin\pdobox\Connection($host, $dbname, $username, $password);
    $items1 = $conn->queryAll("SELECT * FROM city ORDER BY NAME LIMIT 3");
    $items2 = $conn->queryColumn("SELECT name,name_short FROM city ORDER BY NAME LIMIT 10", 1);
    $items3 = $conn->queryRow("SELECT * FROM city ORDER BY NAME LIMIT 10");
    $items4 = $conn->queryCell("SELECT NOW()");
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

