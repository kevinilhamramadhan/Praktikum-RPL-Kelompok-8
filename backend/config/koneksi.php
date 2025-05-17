<?php
$host = "localhost";      
$user = "root";           
$pass = "";               
$db   = "Refairy";


$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// $koneksi = mysqli_connect($host, $user, $pass, $db);

// // Cek koneksi
// if (!$koneksi) {
//     die("Koneksi gagal: ");
// }
// ?>
