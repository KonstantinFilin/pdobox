<?php

require "../vendor/autoload.php";

$host = "127.0.0.1";
$dbname = "ecofenster";
$username = "root";
$password = "123";

try {
    $conn = new \kfilin\pdobox\Connection($host, $dbname, $username, $password);
    $stmt1 = $conn->prepare("SELECT name,timezone_id,office_address FROM city WHERE name LIKE ? AND test = ?");
    $res1 = $conn->executePrepared($stmt1, [ '%аза%', 0 ]);
    $res2 = $conn->executePrepared($stmt1, [ '%на%', 0 ]);
    $res3 = $conn->prepareAndExecute("SELECT name,timezone_id,office_address FROM city WHERE name LIKE ? AND test = ?", [ "%до%", 0 ]);

    // var_dump($res1);
    // var_dump($res2);
    var_dump($res3);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

