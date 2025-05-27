<?php
session_start();
require_once(__DIR__ . '/../config/koneksi.php');  // pastikan di file ini ada $pdo = new PDO(...);

if (!isset($_SESSION['username'])) {
    header("Location: login_db.php");
    exit;
}

$username = $_SESSION['username'];

$sql = "SELECT username, email, employment, photo FROM profil WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

$photo = !empty($user['photo']) ? $user['photo'] : '../../frontend/images/icons/avatar.png';
$email = !empty($user['email']) ? $user['email'] : 'Email not set';
$employment = !empty($user['employment']) ? $user['employment'] : 'Employment info not set';

