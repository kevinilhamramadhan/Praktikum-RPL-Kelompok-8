<?php
$host = "localhost";      // atau "127.0.0.1"
$user = "root";           // user default XAMPP
$pass = "";               // kosong jika pakai XAMPP
$db   = "Refairy";

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
