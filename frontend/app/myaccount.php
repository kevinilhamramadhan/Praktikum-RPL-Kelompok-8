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
            <i class="fas fa-cogs"></i>
            Repair Service
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

            <div class="account">
                <!-- Profile Information Section -->
                <div class="section">
                    <h2 class="section-title">Profile Information</h2>
                    <div class="profile-info">

                                <div class="profile-avatar">
                                    <img src="<?php echo htmlspecialchars($photo); ?>" alt="Profile Photo" style="width:100px; height:100px; border-radius:50%;">
                                </div>
                                <div class="profile-details">
                                    <p id="username"><?php echo htmlspecialchars($username); ?></p>
                                    <p id="email"><?php echo htmlspecialchars($email); ?></p>
                                    <p id="employment"><?php echo htmlspecialchars($employment); ?></p>
                                </div>
                        <button type="button" id="edit-profile-btn" class="edit-profile-btn">Edit Profile</button>

                    </div>
                                                                    <!-- Edit Profile Form (hidden by default) -->
                        <form id="edit-profile-form" style="display:none;" method="POST" action="../../backend/db/myaccount_edit.php" enctype="multipart/form-data">
                            <label for="username-input">Username:</label><br>
                            <input type="text" id="username-input" name="username" value="<?php echo htmlspecialchars($username); ?>" required><br>

                            <label for="email-input">Email:</label><br>
                            <input type="email" id="email-input" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>

                            <label for="employment-input">Employment:</label><br>
                            <input type="text" id="employment-input" name="employment" value="<?php echo htmlspecialchars($employment); ?>"><br>

                            <label for="photo-input">Profile Photo:</label><br>
                            <input type="file" id="photo-input" name="photo" accept="image/*"><br><br>

                            <button type="submit">Save Changes</button>
                            <button type="button" id="cancel-edit-btn">Cancel</button>
                        </form>
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
                        <button class="logout-btn">Logout</button>
                    </div>
                </div>

                
            </div>
        </div>
    </div>

    <!-- Simple JavaScript for toggling features if needed -->
    <script src ="../script/myaccount_script.js"></script>
</body>
</html>