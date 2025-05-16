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
                <a href="../management/data_customer/index.php" class="submenu-item">Data Constumer Management</a>
                <a href="../management/data_sparepart/index.php" class="submenu-item">Data Sparepart Management</a>
            </div>
        </div>
        
        <a href="../inventory/index.php" class="menu-item">
            <i class="fas fa-boxes"></i>
            Inventory
        </a>
        
        <a href="../repair_service/index.php" class="menu-item">
            <i class="fas fa-cogs"></i>
            Repair Service
        </a>
        
        <a href="../help/index.php" class="menu-item">
            <i class="fas fa-info-circle"></i>
            Help
        </a>
        
        <a href="../app/myaccount.php" class="menu-item active">
              <i class="fas fa-user"></i>
            My Account
        </a>

    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>My Account</h1>
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

            <div class="account">
                <!-- Profile Information Section -->
                <div class="section">
                    <h2 class="section-title">Profile Information</h2>
                    <div class="profile-info">
                        <div class="profile-avatar"></div>
                        <div class="profile-details">
                            <h2>Leopoldo Benavent Villada</h2>
                            <p>Leopoldobenavent@reangel.com</p>
                            <p>Joined April 2025</p>
                        </div>
                        <button class="edit-profile-btn">Edit Profile</button>
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