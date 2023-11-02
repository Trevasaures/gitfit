<?php
$host = 'localhost';
$db   = 'fitness_db';
$user = 'root'; // default user for XAMPP
$pass = '';     // default password for XAMPP is empty
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
