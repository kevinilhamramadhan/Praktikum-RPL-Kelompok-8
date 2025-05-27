<?php
session_start();
include '../config/koneksi.php'; // koneksi database PDO disiapkan di sini

// Ambil data dari form POST
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$employment = $_POST['employment'] ?? '';

// Ambil user ID dari session (pastikan sudah diset sebelumnya)
$profilId = $_SESSION['profil_id'] ?? null;

if (!$profilId) {
    header("Location: ../../frontend/app/myaccount.php?update=error_noprofile");
    exit;
}// Pastikan `user_id` disimpan di session saat login

// Default photo path dari user sebelumnya
$photoPath = $_SESSION['photo'] ?? '';

// Upload file foto jika ada
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $uploadDir = '../uploads/profile_photos/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['photo']['name']);
    $targetFile = $uploadDir . time() . "_" . $fileName;

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
        $photoPath = $targetFile;
    }
}

try {
    // Persiapkan statement update
    $sql = "UPDATE profil SET username = :username, email = :email, employment = :employment, photo = :photo WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':email' => $email,
        ':employment' => $employment,
        ':photo' => $photoPath,
        ':id' => $profilId
    ]);
    if ($stmt->rowCount() > 0) {
        // Update session variable
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['employment'] = $employment;
        $_SESSION['photo'] = $photoPath;
        header("Location: ../../frontend/app/myaccount.php?update=success");
    } else {
        header("Location: ../../frontend/app/myaccount.php?update=failed");
    }
} catch (PDOException $e) {
    // Tangani error PDO
    error_log("PDO Error: " . $e->getMessage());
    header("Location: ../../frontend/app/myaccount.php?update=error");
}
exit;
?>
