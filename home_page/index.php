<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #1c1c1c;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            width: 100%;
            height: 100vh;
            display: flex;;
            border-radius: 5px;
        }

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
            height: 100vh;
        }

        .stats {
            display: flex;
            justify-content: flex-end;
            padding: 15px 20px;
            gap: 10px;
        }
        
        .stat-card {
            width: 80px;
            height: 75px;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
        }
        
        .stat-card.total {
            background-color: #1c1c1c;
            border: 1px solid #444;
        }
        
        .stat-card.progress {
            background-color: #b8860b;
        }
        
        .stat-card.completed {
            background-color: #00a651;
        }
        
        .stat-card .number {
            font-size: 24px;
            font-weight: bold;
        }
        
        .stat-card .label {
            font-size: 12px;
        }
        
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
        
        .workshop-notes {
            padding: 0 20px 20px;
            flex: 1;
        }
        
        .section-title {
            color: white;
            margin-bottom: 15px;
        }
        
        .notes-table {
            width: 100%;
            border-collapse: collapse;
            color: white;
            overflow-y: auto;
        }
        
        .notes-table th {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #333;
        }
        
        .notes-table td {
            padding: 10px;
            border-bottom: 1px solid #333;
        }
        
        .status {
            padding: 3px 8px;
            border-radius: 15px;
            font-size: 12px;
        }
        
        .status.in-progress {
            background-color: #b8860b;
            color: white;
        }
        
        .status.completed {
            background-color: #00a651;
            color: white;
        }
        
        .action-btn {
            width: 25px;
            height: 25px;
            border: none;
            background-color: transparent;
            color: #00a651;
            cursor: pointer;
            margin-right: 5px;
        }
        
        .action-btn.delete {
            color: #ff4d4d;
        }
        
        .settings-icon {
            color: #00a651;
            cursor: pointer;
            margin-left: 15px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo-container">
                <img class="logo" src="../images/logo/Logo-group.png" alt="logo">
            </div>
            
            <a href="../home_page/index.php" class="menu-item active">
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
            
            <a href="../my_account/index.php" class="menu-item">
                <i class="fas fa-user"></i>
                My Account
            </a>
        </div>
        
        <div class="main-content">
            <div class="header">
                <h1>Dashboard</h1>
                <div class="user-info">
                    <span class="email">Leopoldobenavent@reangel.com</span>
                    <div class="user-icon">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="stats">
                    <div class="stat-card total">
                        <div class="number">3</div>
                        <div class="label">Total Notes</div>
                    </div>
                    <div class="stat-card progress">
                        <div class="number">2</div>
                        <div class="label">In Progress</div>
                    </div>
                    <div class="stat-card completed">
                        <div class="number">1</div>
                        <div class="label">Completed</div>
                    </div>
                </div>
                
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Gallirei</td>
                                <td>+49xxxxx</td>
                                <td><span class="status in-progress">In Progress...</span></td>
                                <td>21/01/2025</td>
                                <td>FairyFix Engine Check</td>
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Dijkstraa</td>
                                <td>+31xxxxx</td>
                                <td><span class="status in-progress">In Progress...</span></td>
                                <td>16/01/2025</td>
                                <td>SparkFly Brake Restore</td>
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Polo</td>
                                <td>+31xxxxx</td>
                                <td><span class="status completed">Completed</span></td>
                                <td>12/01/2025</td>
                                <td>GreenGlow Cooling Service</td>
                                <td>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript untuk interaksi dasar
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
            
            // Simulasi pencarian
            const searchInput = document.querySelector('.search-input');
            const searchBtn = document.querySelector('.search-btn');
            
            searchBtn.addEventListener('click', function() {
                const searchValue = searchInput.value.toLowerCase();
                // Di sini biasanya akan memanggil API atau melakukan filter
                alert('Mencari: ' + searchValue);
            });
            
            // Simulasi tombol aksi
            const editButtons = document.querySelectorAll('.action-btn.edit');
            const deleteButtons = document.querySelectorAll('.action-btn.delete');
            
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const name = row.cells[1].textContent;
                    alert('Edit entry: ' + name);
                });
            });
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const name = row.cells[1].textContent;
                    if(confirm('Apakah Anda yakin ingin menghapus data ' + name + '?')) {
                        // Di sini biasanya akan memanggil API untuk delete
                        row.remove();
                        updateStats();
                    }
                });
            });
            
            function updateStats() {
                const totalRows = document.querySelectorAll('.notes-table tbody tr').length;
                const inProgressRows = document.querySelectorAll('.status.in-progress').length;
                const completedRows = document.querySelectorAll('.status.completed').length;
                
                document.querySelector('.stat-card.total .number').textContent = totalRows;
                document.querySelector('.stat-card.progress .number').textContent = inProgressRows;
                document.querySelector('.stat-card.completed .number').textContent = completedRows;
            }
        });
    </script>
</body>
</html>