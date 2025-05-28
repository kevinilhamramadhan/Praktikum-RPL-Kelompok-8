<?php
session_start();
require_once(__DIR__ . '/../config/koneksi.php');  // Koneksi database PDO

// Jika belum login, arahkan ke halaman login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_db.php");
    exit;
}

$adminId = $_SESSION['admin_id'];

// Ambil data profil dari database berdasarkan admin_id
$sql = "SELECT username, email, employment, photo FROM profil WHERE admin_id = :admin_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':admin_id', $adminId, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Set nilai default jika profil belum ada
$username = $user['username'] ?? 'Name not set';
$email = $user['email'] ?? 'Email not set';
$employment = $user['employment'] ?? 'Employment info not set';
$photo = !empty($user['photo']) ? $user['photo'] : '../../frontend/images/icons/icon2.png';
?>
