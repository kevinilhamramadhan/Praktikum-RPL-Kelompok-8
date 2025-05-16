<?php
session_start();
include '../config/koneksi.php'; // file koneksi ke database

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    die("Username atau password tidak boleh kosong.");
}

// Cek ke database
$query = "SELECT * FROM admins WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && md5($password) === $user['password']) {
    // Login berhasil
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header("Location: ../../frontend/app/homepage.php");
    exit();
} else {
    // Login gagal
    echo "<script>alert('Username atau password salah!'); window.history.back();</script>";
}

?>
