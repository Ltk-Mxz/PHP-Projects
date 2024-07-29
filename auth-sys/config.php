<?php
$host = "localhost";
$dbname = "auth_sys";
$user = "root";
$pass = "<ubuntu&M0096>";

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$conn = new PDO($dsn, $user, $pass, $options);

// try {
//     $conn = new PDO($dsn, $user, $pass, $options);
// } catch (PDOException $e) {
//     echo $e->getMessage();
// }

?>