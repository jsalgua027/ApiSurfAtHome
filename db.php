<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, token, Content-Type, cache-control");
header('Content-Type: application/json');

$host = 'localhost';
$db_name = 'bd_surfathome';
$username = 'jose'; // Cambia esto si tu usuario de MySQL es diferente
$password = 'josefa'; // Cambia esto si tienes una contraseña para MySQL
try {
    $pdo= new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
} catch (PDOException $e) {
    echo 'Connection error: ' . $e->getMessage();
}
