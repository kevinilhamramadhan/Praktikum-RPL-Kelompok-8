<?php
$host = "localhost";      
$user = "root";           
$pass = "";               
$db   = "Refairy";

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: ");
}
?>
