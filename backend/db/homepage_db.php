<?php
session_start();
require_once(__DIR__ . '/../config/koneksi.php');

// verifikasi autologin
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE remember_token = ? AND token_expiry > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id']; 
    }
}


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


try {
    // Ambil data dari tabel management
    $stmt = $pdo->prepare("SELECT * FROM management ORDER BY date_last_visit DESC");
    $stmt->execute();
    $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Hitung progres
    $total = count($notes);
    $in_progress = 0;
    $completed = 0;

    foreach ($notes as $note) {
        if (strtolower($note['progress']) === 'complete') {
            $completed++;
        } else {
            $in_progress++;
        }
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    die();
}
// menampilkan email
// $stmt = $pdo->query("SELECT email FROM admins LIMIT 1");
// $row = $stmt->fetch(PDO::FETCH_ASSOC);

// if ($row) {
//     $email = $row['email'];
// } else {
//     $email = "Email tidak ditemukan";
// }

?>