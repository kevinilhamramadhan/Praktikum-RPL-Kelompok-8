<?php
require '../../backend/db/homepage_db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/homepage_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo-container">
                <img class="logo" src="../images/logo/Logo-group.png" alt="logo">
            </div>
            
            <a href="homepage.php" class="menu-item active">
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
                <i class="fas fa-cogs"></i>
                History Service
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
        
        <div class="main-content">
            <div class="header">
                <h1>Dashboard</h1>
                <div class="user-info">
                    <span class="email"></span>
                    <div class="user-icon">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="stats">
                    <div class="stat-card total">
                        <div class="number"><?php echo $total; ?></div>
                        <div class="label">Total Notes</div>
                    </div>
                    <div class="stat-card progress">
                        <div class="number"><?php echo $in_progress; ?></div>
                        <div class="label">In Progress</div>
                    </div>
                    <div class="stat-card completed">
                        <div class="number"><?php echo $completed; ?></div>
                        <div class="label">Complete</div>
                    </div>
                </div>
                
                <div class="search-bar">
                    <div class="search-container">
                        <input type="text" placeholder="Search" class="search-input" id="searchInput">
                        <button class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <div class="settings-icon">
                        <i class="fas fa-sliders-h"></i>
                    </div>
                </div>
                
                <div class="workshop-notes">
                    <h2 class="section-title">Latest Workshop Notes</h2>
                    <table class="notes-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Progress</th>
                                <th>Date of Last Visit</th>
                                <th>Repair Service</th>

                            </tr>
                        </thead>
                        <tbody id="notesTableBody">
                            <?php $no = 1; foreach ($notes as $note): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($note['name']); ?></td>
                                <td><?= htmlspecialchars($note['contact']); ?></td>
                                <td>
                                    <?php if (strtolower($note['progress']) === 'complete'): ?>
                                        <span class="status completed">Completed</span>
                                    <?php else: ?>
                                        <span class="status in-progress">In Progress...</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y', strtotime($note['date_last_visit'])); ?></td>
                                <td><?= htmlspecialchars($note['repair_service']); ?></td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../script/homepage_script.js"></script>
</body>
</html>