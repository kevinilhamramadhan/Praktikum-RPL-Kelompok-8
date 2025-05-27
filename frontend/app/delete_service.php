<?php
require_once '../../backend/config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'] ?? '';

    if (!$code) {
        die("Kode layanan tidak ditemukan.");
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM repair WHERE code = ?");
        $stmt->execute([$code]);
        header("Location: repair.php");
        exit;
    } catch (PDOException $e) {
        die("Gagal menghapus layanan: " . $e->getMessage());
    }
} else {
    // Jika akses bukan POST, langsung redirect
    header("Location: repair.php");
    exit;
}
