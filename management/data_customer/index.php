<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Consumer Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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
        
        .sidebar {
            width: 340px;
            background-color: #1c1c1c;
            border-right: 1px solid #00a651;
            min-height: 100vh;
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
        
        .content {
            background-image: url('../../images/backgrounds/background.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 88vh;
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
        
        .settings-icon {
            color: #00a651;
            cursor: pointer;
            margin-left: 15px;
        }
        
        .data-table-container {
            flex: 1;
            padding: 0 20px 20px 20px;
            overflow-x: auto;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .data-table th {
            text-align: left;
            padding: 12px 15px;
            background-color: #1c1c1c;
            color: white;
            border-bottom: 1px solid #333;
        }
        
        .data-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #333;
        }
        
        .action-btn {
            background-color: transparent;
            border: none;
            color: #00a651;
            cursor: pointer;
            margin-right: 10px;
            font-size: 16px;
        }
        
        .action-btn.delete {
            color: #ff4d4d;
        }
        
        .truncate {
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Edit Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: end;
            align-items: center;
            z-index: 1000;
            display: none;
        }
        
        .edit-modal {
            background-color: #1c1c1c;
            border: 2px solid #00a651;
            border-radius: 10px;
            width: 500px;
            height: 90vh;
            padding: 20px;
            position: relative;
            overflow-y: auto;
        }
        
        .modal-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: white;
        }
        
        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            color: #00a651;
            background: none;
            border: none;
            cursor: pointer;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #00a651;
            font-size: 18px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            background-color: #1c1c1c;
            border: 1px solid #333;
            border-radius: 5px;
            color: white;
            font-size: 16px;
        }
        
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        
        .btn {
            padding: 12px 0;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            width: 45%;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }
        
        .btn-save {
            background-color: #00a651;
            color: white;
        }
        
        .btn-cancel {
            background-color: transparent;
            border: 1px solid #00a651;
            color: #00a651;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-container">
            <img class="logo" src="../../images/logo/Logo-group.png" alt="logo">
        </div>
        
        <a href="../../home_page/index.php" class="menu-item">
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
                <a href="../../management/data_customer/index.php" class="submenu-item active">Data Constumer Management</a>
                <a href="../../management/data_sparepart/index.php" class="submenu-item">Data Sparepart Management</a>
            </div>
        </div>
        
        <a href="../../inventory/index.php" class="menu-item">
            <i class="fas fa-boxes"></i>
            Inventory
        </a>
        
        <a href="../../repair_service/index.php" class="menu-item">
            <i class="fas fa-wrench"></i>
            Repair Service
        </a>
        
        <a href="../../help/index.php" class="menu-item">
            <i class="fas fa-question-circle"></i>
            Help
        </a>
        
        <a href="../../my_account/index.php" class="menu-item">
            <i class="fas fa-user"></i>
            My Account
        </a>
    </div>
    
    <div class="main-content">
        <div class="header">
            <h1>Data Constumer Management</h1>
            <div class="user-info">
                <span class="email">Leopoldobenavent@reangel.com</span>
                <div class="user-icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
        <div class="content">
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Gallirei</td>
                            <td>+49xxxxx</td>
                            <td class="truncate">Goethestra...</td>
                            <td>21/04/2025</td>
                            <td>FairyFix Engine Check</td>
                            <td>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Dijkstraa</td>
                            <td>+31xxxxx</td>
                            <td class="truncate">Nieuwezijde...</td>
                            <td>16/04/2025</td>
                            <td>SparkFly Brake Restore</td>
                            <td>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Polo</td>
                            <td>+34xxxxx</td>
                            <td class="truncate">Calle Mayor...</td>
                            <td>12/04/2025</td>
                            <td>GreenGlow Cooling Service</td>
                            <td>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Customer Modal -->
    <div id="editModal" class="modal-overlay">
        <div class="edit-modal">
            <h2 class="modal-title">Edit Customer</h2>
            <button class="close-btn">&times;</button>
            
            <form id="editCustomerForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" value="">
                </div>
                
                <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="text" id="contact" class="form-control" value="">
                </div>
                
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" class="form-control" value="">
                </div>
                
                <div class="form-group">
                    <label for="lastVisit">Date of Last Visit</label>
                    <input type="text" id="lastVisit" class="form-control" value="">
                </div>
                
                <div class="form-group">
                    <label for="repairService">Repair Service</label>
                    <textarea id="repairService" class="form-control"></textarea>
                </div>
                
                <div class="btn-container">
                    <button type="button" class="btn btn-save">Save</button>
                    <button type="button" class="btn btn-cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>

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
            
            // Search functionality
            const searchInput = document.querySelector('.search-input');
            const searchBtn = document.querySelector('.search-btn');
            
            searchBtn.addEventListener('click', function() {
                const searchValue = searchInput.value.toLowerCase();
                // Search would be implemented with PHP
                alert('Searching for: ' + searchValue);
            });
            
            // Edit Modal functionality
            const editModal = document.getElementById('editModal');
            const editButtons = document.querySelectorAll('.action-btn.edit');
            const closeBtn = document.querySelector('.close-btn');
            const cancelBtn = document.querySelector('.btn-cancel');
            const saveBtn = document.querySelector('.btn-save');
            
            // Form fields
            const nameField = document.getElementById('name');
            const contactField = document.getElementById('contact');
            const addressField = document.getElementById('address');
            const lastVisitField = document.getElementById('lastVisit');
            const repairServiceField = document.getElementById('repairService');
            
            // Open modal with customer data
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const name = row.cells[1].textContent;
                    const contact = row.cells[2].textContent;
                    const address = row.cells[3].textContent;
                    const lastVisit = row.cells[4].textContent;
                    const repairService = row.cells[5].textContent;
                    
                    // Populate form fields
                    nameField.value = name;
                    contactField.value = contact;
                    
                    // For address, we want to display the full address, not truncated
                    // In a real app, we would fetch the full address from the database
                    if (name === 'Polo') {
                        addressField.value = "Calle Mayor No. 8, 2ºA, Centro, Madrid";
                    } else if (name === 'Gallirei') {
                        addressField.value = "Goethestrasse 15, Berlin, Germany";
                    } else if (name === 'Dijkstraa') {
                        addressField.value = "Nieuwezijde 345, Amsterdam, Netherlands";
                    } else {
                        addressField.value = address;
                    }
                    
                    lastVisitField.value = lastVisit;
                    repairServiceField.value = repairService;
                    
                    // Show modal
                    editModal.style.display = 'flex';
                });
            });
            
            // Close modal
            closeBtn.addEventListener('click', function() {
                editModal.style.display = 'none';
            });
            
            cancelBtn.addEventListener('click', function() {
                editModal.style.display = 'none';
            });
            
            // Save changes
            saveBtn.addEventListener('click', function() {
                // Get the updated values
                const name = nameField.value;
                const contact = contactField.value;
                const address = addressField.value;
                const lastVisit = lastVisitField.value;
                const repairService = repairServiceField.value;
                
                // In a real app, we would send this data to the server
                alert('Customer data updated for: ' + name);
                
                // Find the row in the table and update it
                const rows = document.querySelectorAll('.data-table tbody tr');
                rows.forEach(row => {
                    if (row.cells[1].textContent === name || 
                        nameField.dataset.originalName === row.cells[1].textContent) {
                        row.cells[1].textContent = name;
                        row.cells[2].textContent = contact;
                        
                        // For address, we want to truncate if it's too long
                        if (address.length > 12) {
                            row.cells[3].textContent = address.substring(0, 12) + '...';
                        } else {
                            row.cells[3].textContent = address;
                        }
                        row.cells[3].className = 'truncate';
                        row.cells[3].title = address; // Set full address as tooltip
                        
                        row.cells[4].textContent = lastVisit;
                        row.cells[5].textContent = repairService;
                    }
                });
                
                // Close modal
                editModal.style.display = 'none';
            });
            
            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                if (e.target === editModal) {
                    editModal.style.display = 'none';
                }
            });
            
            // Delete button functionality
            const deleteButtons = document.querySelectorAll('.action-btn.delete');
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const name = row.cells[1].textContent;
                    if(confirm('Are you sure you want to delete data for ' + name + '?')) {
                        // Delete row (in a full implementation this would call an API)
                        row.remove();
                    }
                });
            });
        });
    </script>
</body>
</html>