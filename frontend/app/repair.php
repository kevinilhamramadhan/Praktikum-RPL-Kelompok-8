<?php
require_once '../../backend/config/koneksi.php';  // koneksi PDO

try {
    $stmt = $pdo->query("SELECT code, service_name, description FROM repair");
    $services = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../style/repair_style.css">
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
                <a href="../management/data_customer/index.php" class="submenu-item">Data Constumer Management</a>
                <a href="../management/data_sparepart/index.php" class="submenu-item">Data Sparepart Management</a>
            </div>
        </div>
        
        <a href="../inventory/index.php" class="menu-item">
            <i class="fas fa-boxes"></i>
            Inventory
        </a>
        
        <a href="repair.php" class="menu-item active">
            <i class="fas fa-wrench"></i>
            Repair Service
        </a>
        
        <a href="help.php" class="menu-item">
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
            <h1>Repair Service</h1>
            <div class="user-info">
                <span class="email">Leopoldobenavent@reangel.com</span>
                <div class="user-icon">
                    <i class="fas fa-user"></i>
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
                <div class="settings-icon">
                    <i class="fas fa-sliders-h"></i>
                </div>
            </div>

            <!-- Add Button -->
            <div class="add-button">
                <a href="add_service.php" style="text-decoration: none; color: inherit;">
                    <i class="fas fa-plus"></i> Add Service
                </a>
            </div>

            <!-- Service Table -->
            <table class="service-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Service Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?= htmlspecialchars($service['code']) ?></td>
                        <td><?= htmlspecialchars($service['service_name']) ?></td>
                        <td><?= htmlspecialchars($service['description']) ?></td>
                        <td>
                            <div class="action-buttons">
                                <!-- Tombol Edit  -->
                                <a href="edit_service.php?code=<?= urlencode($service['code']) ?>" class="action-button edit-button" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Tombol Delete  -->
                                <form action="delete_service.php" method="post" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus layanan ini?');">
                                    <input type="hidden" name="code" value="<?= htmlspecialchars($service['code']) ?>" />
                                    <button type="submit" class="action-button delete-button" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>  
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($services)): ?>
                    <tr>
                        <td colspan="4">No services found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../script/repair_script.js"></script>
</body>
</html>
