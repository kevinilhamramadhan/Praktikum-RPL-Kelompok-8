<?php
$host = "localhost";
$user = "root";
$password = "";  // kosongkan jika memang tidak ada password
$dbname = "inventory_db";

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
