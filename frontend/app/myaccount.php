<?php
include '../../backend/db/myaccount.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../style/myaccount_style.css">
</head>
<body>
    <!-- Sidebar Navigation -->
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
        
        <a href="repair.php"class="menu-item">
            <i class="fas fa-wrench"></i>
            History Service
        </a>
        
        <a href="help.php" class="menu-item">
            <i class="fas fa-info-circle"></i>
            Help
        </a>
        
        <a href="myaccount.php" class="menu-item active">
              <i class="fas fa-user"></i>
            My Account
        </a>

    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="header">
            <h1>My Account</h1>
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


            <div class="account">
                <!-- Profile Information Section -->
                <div class="section">
                    <h2 class="section-title">Profile Information</h2>
                    <div class="profile-info">

                                <div class="profile-avatar">
                                    <img src="../../backend/profile_photos/<?php echo htmlspecialchars($photo); ?>" alt="Profile Photo" style="width:100px; height:100px; border-radius:50%;">
                                </div>
                                <div class="profile-details">
                                    <p id="username"><?php echo htmlspecialchars($username); ?></p>
                                    <p id="email"><?php echo htmlspecialchars($email); ?></p>
                                    <p id="employment"><?php echo htmlspecialchars($employment); ?></p>
                                </div>
                        <button type="button" id="edit-profile-btn" class="edit-profile-btn">Edit Profile</button>

                    </div>


                </div>
                <div id="popup-overlay" class="popup-overlay">
                    <div class="popup-content">
                        <button class="close-btn" id="close-popup">&times;</button>
                        
                        <form id="edit-profile-form" class="popup-form" method="POST" action="../../backend/db/myaccount_edit.php" enctype="multipart/form-data">
                            <h3>Edit Profile</h3>
                            
                            <div class="form-group">
                                <label for="username-input">Username:</label>
                                <input type="text" id="username-input" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="email-input">Email:</label>
                                <input type="email" id="email-input" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="employment-input">Employment:</label>
                                <input type="text" id="employment-input" name="employment" value="<?php echo htmlspecialchars($employment); ?>">
                            </div>

                            <div class="form-group">
                                <label for="photo-input">Profile Photo:</label>
                                <input type="file" id="photo-input" name="photo" accept="image/*">
                            </div>

                            <div class="form-buttons">
                                <button type="button" id="cancel-edit-btn" class="btn btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Account Preferences Section -->
                <div class="section">
                    <h2 class="section-title">Account Preferences</h2>
                    <div class="preference-item">
                        <span>Notification</span>
                        <button class="enable-btn">
                            Enable <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="preference-item">
                        <span>Activity</span>
                    </div>
                    <div class="preference-item">
                        <span>Switch Account</span>
                        <button id="logoutButton" class="logout-btn" onclick="window.location.href='../../backend/db/logout.php'">Logout</button>

                    </div>
                </div>

                
            </div>
        </div>
    </div>

    <!-- Simple JavaScript for toggling features if needed -->
    <script src ="../script/myaccount_script.js"></script>
</body>
</html>