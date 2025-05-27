<?php
session_start();
require_once '../config/koneksi.php'; // koneksi ke database
header('Content-Type: application/json');

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$remember = isset($_POST['remember']);

if (empty($username) || empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'Username atau password tidak boleh kosong.'
    ]);
    exit;
}

try {
    // Ambil user dari database
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifikasi password (md5 sesuai database kamu)
    if ($user && md5($password) === $user['password']) {
        // Login berhasil
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['admin_id'] = $user['id'];

        if ($remember) {
            // Buat token unik dan simpan di database
            $token = bin2hex(random_bytes(32));
            $expiry = time() + (30 * 24 * 60 * 60); // 30 hari

            // Simpan token dan waktu kedaluwarsa di database
            $update = $pdo->prepare("UPDATE admins SET remember_token = ?, token_expiry = ? WHERE id = ?");
            $update->execute([$token, date('Y-m-d H:i:s', $expiry), $user['id']]);

            // Set cookie dengan token
            setcookie('remember_token', $token, $expiry, "/", "", false, true);
        }
    
    // Ambil data profil setelah login berhasil
    $profilStmt = $pdo->prepare("SELECT * FROM profil WHERE admin_id = ?");
    $profilStmt->execute([$user['id']]);
    $profil = $profilStmt->fetch(PDO::FETCH_ASSOC);

    if ($profil) {
        $_SESSION['profil_id'] = $profil['id']; // ID dari tabel profil
        $_SESSION['email'] = $profil['email'];
        $_SESSION['employment'] = $profil['employment'];
        $_SESSION['photo'] = $profil['photo'];
    }

        // Redirect ke homepage
        echo json_encode([
            'success' => true,
            'redirect' => '../../frontend/app/homepage.php'
        ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Username atau password salah!'
            ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    ]);
}
