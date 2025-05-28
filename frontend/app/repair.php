<?php
session_start();
require_once '../../backend/config/koneksi.php'; // koneksi PDO

try {
    $stmt = $pdo->query("SELECT id, name, date, repair_service, description FROM history ORDER BY date DESC");
    $history = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}

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
    <title>History Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../style/repair_style.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img class="logo" src="../images/logo/Logo-group.png" alt="logo">
        </div>

        <a href="homepage.php" class="menu-item"><i class="fas fa-home"></i> Home</a>

        <div class="has-submenu">
            <a href="#" class="menu-item">
                <i class="fas fa-clipboard-list"></i> Management
                <i class="fas fa-chevron-down submenu-icon rotate-icon"></i>
            </a>
            <div class="submenu">
                <a href="data_customer.php" class="submenu-item">Data Customer Management</a>
                <a href="../management/data_sparepart/index.php" class="submenu-item">Data Sparepart Management</a>
            </div>
        </div>

        <a href="../inventory/index.php" class="menu-item"><i class="fas fa-boxes"></i> Inventory</a>
        <a href="repair.php" class="menu-item active"><i class="fas fa-wrench"></i> History Service</a>
        <a href="help.php" class="menu-item"><i class="fas fa-question-circle"></i> Help</a>
        <a href="myaccount.php" class="menu-item"><i class="fas fa-user"></i> My Account</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Repair History</h1>
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
            <div class="search-bar">
                <div class="search-container">
                    <input type="text" placeholder="Search" class="search-input" id="searchInput">
                    <button class="search-btn"><i class="fas fa-search"></i></button>
                </div>
                
            </div>

            <!-- History Table -->
            <table class="service-table" id="historyTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Repair Service</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="historyTableBody">
                    <?php $no = 1; foreach ($history as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= date('d/m/Y', strtotime($row['date'])) ?></td>
                        <td><?= htmlspecialchars($row['repair_service']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td>
                            <form action="../../backend/db/delete_history.php" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?');" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                                <button type="submit" class="action-button delete-button" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($history)): ?>
                    <tr>
                        <td colspan="6">No history found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../script/repair_script.js"></script>
</body>
</html>
