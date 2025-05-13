<?php
$host = 'localhost';
$username = 'root';        // Ubah jika user Anda bukan 'root'
$password = '';            // Ubah jika user Anda menggunakan password
$database = 'inventory_db';

// Menggunakan MySQLi
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menggunakan PDO (karena functions.php membutuhkan PDO)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("PDO Connection failed: " . $e->getMessage());
}
?>