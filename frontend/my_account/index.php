<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #1c1c1c;
            color: white;
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar Styles */
        .logo-container {
            border-bottom: 1px solid #333;
            display: flex;
            justify-content: center;
        }

        .logo {
            margin-right: 50px;
            align-items: center;
            height: 68px;
        }

        .sidebar {
            width: 340px;
            background-color: #1c1c1c;
            border-right: 1px solid #00a651;
            min-height: 100vh;
        }

        .menu-item {
            padding: 15px 20px;
            border-bottom: 1px solid #333;
            display: flex;
            align-items: center;
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .menu-item i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }
        
        .menu-item:hover, .menu-item.active {
            background-color: #2a2a2a;
            color: #00a651;
            border-left: 4px solid #00a651;
        }
        
        .menu-item.active {
            color: #00a651;
        }
        
        .submenu {
            background-color: #222;
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease-in-out;
        }
        
        .submenu-item {
            padding: 12px 20px 12px 55px;
            display: block;
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .submenu-item:hover {
            background-color: #2a2a2a;
            color: #00a651;
        }
        
        .submenu-item.active {
            color: #00a651;
            background-color: #2a2a2a;
        }
        
        .has-submenu {
            position: relative;
        }
        
        .submenu-icon {
            position: absolute;
            right: 20px;
            transition: transform 0.3s;
        }
        
        .submenu-open {
            max-height: 500px;
        }
        
        .rotate-icon {
            transform: rotate(180deg);
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: #1c1c1c;
            border-bottom: 1px solid #00a651;
            max-height: 12vh;
        }
        
        .header h1 {
            color: white;
            font-size: 28px;
            font-weight: normal;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            color: #f5f5f5;
        }
        
        .user-info .email {
            margin-right: 15px;
        }
        
        .user-icon {
            width: 35px;
            height: 35px;
            background-color: #00a651;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content {
            background-image: url('../images/backgrounds/background.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 88vh;
        }

        /* Search Bar */
        .search-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 20px;
        }
        
        .search-container {
            display: flex;
            width: 250px;
            border: 1px solid #00a651;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .search-input {
            flex: 1;
            padding: 8px 15px;
            border: none;
            background-color: #1c1c1c;
            color: white;
        }
        
        .search-btn {
            width: 40px;
            background-color: #1c1c1c;
            border: none;
            color: #00a651;
            cursor: pointer;
        }

        .settings-icon {
            color: #00a651;
            cursor: pointer;
            margin-left: 15px;
        }

        .account {
            overflow-y: auto;
            height: 75vh;
            padding: 20px;
        }

        /* Content Sections */
        .section {
            margin: 20px;
            background-color: #1e1e1e;
            border-radius: 10px;
            border: 1px solid #2ecc71;
            padding: 20px;
            margin-bottom: 20px;
        }

        .section-title {
            color: #2ecc71;
            margin-bottom: 20px;
            font-size: 20px;
        }

        /* Profile Section */
        .profile-info {
            display: flex;
            align-items: center;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background-color: #ccc;
            border-radius: 50%;
            margin-right: 20px;
        }

        .profile-details h2 {
            margin-bottom: 5px;
        }

        .profile-details p {
            color: #ccc;
            margin-bottom: 5px;
        }

        .edit-profile-btn {
            background-color: #2ecc71;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-left: auto;
        }

        /* Preferences Section */
        .preference-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #333;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #2ecc71;
        }

        input:checked + .slider:before {
            transform: translateX(30px);
        }

        .enable-btn {
            background-color: transparent;
            color: #2ecc71;
            border: 1px solid #2ecc71;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .enable-btn i {
            margin-left: 5px;
        }

        /* Activity Section */
        .activity-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #333;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        /* Icon styling */
        .icon {
            display: inline-block;
            width: 24px;
            height: 24px;
            margin-right: 10px;
            background-size: contain;
        }

        /* Utility Classes */
        .divider {
            height: 1px;
            background-color: #333;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="logo-container">
            <img class="logo" src="../images/logo/Logo-group.png" alt="logo">
        </div>
        
        <a href="../home_page/index.php" class="menu-item">
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
            <i class="fas fa-wrench"></i>
            Repair Service
        </a>
        
        <a href="../help/index.php" class="menu-item">
            <i class="fas fa-question-circle"></i>
            Help
        </a>
        
        <a href="../my_account/index.php" class="menu-item active">
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
                        <span>Dark Mode</span>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="preference-item">
                        <span>Notification</span>
                        <button class="enable-btn">
                            Enable <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Activity Section -->
                <div class="section">
                    <h2 class="section-title">Activity</h2>
                    <div class="activity-item">
                        <span>Edited Spareparts Data</span>
                        <i class="fas fa-chevron-right" style="color: #2ecc71;"></i>
                    </div>
                    <div class="activity-item">
                        <span>Added A New Customer</span>
                        <i class="fas fa-chevron-right" style="color: #2ecc71;"></i>
                    </div>
                    <div class="activity-item">
                        <span>Logged In</span>
                        <i class="fas fa-chevron-right" style="color: #2ecc71;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple JavaScript for toggling features if needed -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Submenu toggle
            const hasSubmenu = document.querySelector('.has-submenu');
            const submenuIcon = document.querySelector('.submenu-icon');
            const submenu = document.querySelector('.submenu');
            
            hasSubmenu.addEventListener('click', function(e) {
                if (e.target.closest('.submenu-item')) return;
                e.preventDefault();
                submenu.classList.toggle('submenu-open');
                submenuIcon.classList.toggle('rotate-icon');
            });
        })
        // Example: Toggle dark mode
        document.querySelector('.toggle-switch input').addEventListener('change', function() {
            // Here you would add actual functionality to toggle dark/light mode
            console.log('Dark mode toggled:', this.checked);
        });

        // Example: Activity item click
        document.querySelectorAll('.activity-item').forEach(item => {
            item.addEventListener('click', function() {
                // Here you would navigate to activity details page
                console.log('Activity clicked:', this.querySelector('span').textContent);
            });
        });
    </script>
</body>
</html>