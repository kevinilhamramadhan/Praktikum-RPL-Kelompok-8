<?php
session_start();
require '../../backend/config/koneksi.php';

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
    <title>Data Consumer Management</title>
    <link rel="stylesheet" href="../style/data_customer_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo-container">
            <img class="logo" src="../../frontend/images/logo/Logo-group.png" alt="logo">
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
                <a href="data_customer.php" class="submenu-item active">Data Consumer Management</a>
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
            <h1>Data Consumer Management</h1>
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
                <button class="add-customer-btn" id="addCustomerBtn">
                    <i class="fas fa-plus"></i>
                    Add Customer
                </button>
                <div class="search-controls">
                    <div class="search-container">
                        <input type="text" placeholder="Search" class="search-input" id="searchInput">
                        <button class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                </div>
            </div>
            
            <div class="data-table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Date of Last Visit</th>
                            <th>Repair Service</th>
                            <th>Description</th>
                            <th>Progress</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add/Edit Customer Modal -->
    <div id="editModal" class="modal-overlay">
        <div class="edit-modal">
            <h2 class="modal-title">Add Customer</h2>
            <button class="close-btn" title="Close">&times;</button>
            
            <form id="editCustomerForm">
                <div class="form-group">
                    <label for="name">Name <span class="required">*</span></label>
                    <input type="text" id="name" class="form-control" value="" required>
                </div>
                
                <div class="form-group">
                    <label for="contact">Contact <span class="required">*</span></label>
                    <input type="text" id="contact" class="form-control" value="" required>
                </div>
                
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" class="form-control" value="" placeholder="Enter customer address">
                </div>
                
                <div class="form-group">
                    <label for="lastVisit">Date of Last Visit</label>
                    <input type="date" id="lastVisit" class="form-control date-input" value="">
                </div>
                
                <div class="form-group">
                    <label for="repairService">Repair Service</label>
                    <textarea id="repairService" class="form-control" rows="3" placeholder="Enter repair service details"></textarea>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" rows="3" placeholder="Enter detailed description of the service or repair"></textarea>
                </div>

                <div class="form-group">
                    <label for="progress">Progress Status</label>
                    <select id="progress" class="form-control">
                        <option value="in-progress">In Progress</option>
                        <option value="complete">Complete</option>
                    </select>
                </div>
                
                <div class="btn-container">
                    <button type="button" class="btn btn-save" id="saveBtn">
                        <i class="fas fa-save"></i>
                        Save
                    </button>
                    <button type="button" class="btn btn-cancel">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay" style="display: none;">
        <div class="loading-spinner">
            <i class="fas fa-spinner fa-spin"></i>
            <p>Saving customer data...</p>
        </div>
    </div>

    <script src="../script/data_customer_script.js"></script>
</body>
</html>