<?php
session_start();
require_once '../../backend/config/koneksi.php'; // koneksi PDO

// menampilkan email
$adminId = $_SESSION['admin_id'];
$query = "SELECT email, photo FROM profil WHERE admin_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$adminId]);
$profil = $stmt->fetch(PDO::FETCH_ASSOC);

// Set nilai default jika data tidak ada
$email = !empty($profil['email']) ? $profil['email'] : 'Email not set';
$fotoProfil = !empty($profil['photo']) ? $profil['photo'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../style/help_style.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img class="logo" src="../images/logo/Logo-group.png" alt="logo">
        </div>
        
        <a href="homepage.php" class="menu-item">
            <i class="fas fa-home"></i>
            Home
        </a>
        
        <div class="has-submenu">
            <a href="#" class="menu-item">
                <i class="fas fa-clipboard-list"></i>
                Management
                <i class="fas fa-chevron-down submenu-icon rotate-icon"></i>
            </a>
            <div class="submenu">
                <a href="data_customer.php" class="submenu-item">Data Constumer Management</a>
                <a href="../management/data_sparepart/index.php" class="submenu-item">Data Sparepart Management</a>
            </div>
        </div>
        
        <a href="../inventory/index.php" class="menu-item">
            <i class="fas fa-boxes"></i>
            Inventory
        </a>
        
        <a href="repair.php" class="menu-item">
            <i class="fas fa-wrench"></i>
            History Service
        </a>
        
        <a href="help.php" class="menu-item active">
            <i class="fas fa-question-circle"></i>
            Help
        </a>
        
        <a href="myaccount.php" class="menu-item">
            <i class="fas fa-user"></i>
            My Account
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Help</h1>
                <div class="user-info">
                    <span class="email"><?php echo htmlspecialchars($email); ?></span>
                    <div class="user-icon">
                        <?php if ($fotoProfil): ?>
                            <img src="../../backend/profile_photos/<?php echo htmlspecialchars($fotoProfil); ?>" alt="Profile Photo" style="width: 35px; height: 35px; border-radius: 50%;">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                </div>
        </div>
        <div class="content">
            <!-- Search Bar -->
            <div class="search-bar">
                <div class="search-container">
                    <input type="text" placeholder="Search" class="search-input">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
            </div>

            <div class="help">
                <!-- User Guide Section -->
                <div class="help-section">
                    <div class="section-title">
                        <i class="fas fa-tools"></i>
                        User Guide
                    </div>
                    <ul class="help-list">
                        <li><a href="#" class="help-link">Adding Sparepart Data</a></li>
                        <li><a href="#" class="help-link">Modifying Customer Info</a></li>
                        <li><a href="#" class="help-link">Viewing Reports</a></li>
                    </ul>
                </div>

                <!-- FAQ Section -->
                <div class="help-section">
                    <div class="section-title">
                        <i class="fas fa-question-circle"></i>
                        FAQ
                    </div>
                    <ul class="help-list">
                        <li><a href="#" class="help-link">How Do I Reset My Password?</a></li>
                        <li><a href="#" class="help-link">Why Can't I See My Data</a></li>
                        <li><a href="#" class="help-link">How To Fix A Stock Error?</a></li>
                    </ul>
                </div>

                <!-- Contact Us Section -->
                <div class="help-section">
                    <div class="section-title">
                        <i class="fas fa-envelope"></i>
                        Contact Us
                    </div>
                    <ul class="help-list">
                        <li><a href="#" class="help-link">E-mail Us</a></li>
                        <li><a href="#" class="help-link">Report A Bug</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="../script/help_script.js"></script>
</body>
</html>