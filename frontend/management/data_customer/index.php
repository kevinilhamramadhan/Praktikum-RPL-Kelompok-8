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
    background-image: url('../images/backgrounds/background.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 88vh;
}

.search-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
}

.add-customer-btn {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    background-color: #00a651;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    transition: background-color 0.3s;
}

.add-customer-btn:hover {
    background-color: #008a44;
}

.add-customer-btn i {
    margin-right: 8px;
}

.search-controls {
    display: flex;
    align-items: center;
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

/* Modal Styles */
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

.status-badge {
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: bold;
    text-align: center;
    display: inline-block;
}

.status-badge.complete {
    background-color: #00a651;
    color: white;
}

.status-badge.in-progress {
    background-color: #ffa500;
    color: white;
}

.form-control.date-input {
    cursor: pointer;
}

.form-control:focus {
    outline: none;
    border-color: #00a651;
    box-shadow: 0 0 5px rgba(0, 166, 81, 0.3);
}

select.form-control {
    cursor: pointer;
}

/* Required field indicator */
.required {
    color: #e74c3c;
    font-weight: bold;
}

/* Loading overlay */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
}

.loading-spinner {
    background: white;
    padding: 20px 30px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.loading-spinner i {
    font-size: 24px;
    color: #3498db;
    margin-bottom: 10px;
}

.loading-spinner p {
    margin: 0;
    color: #666;
}

/* Button icons */
.btn i {
    margin-right: 5px;
}

/* Loading state for table */
.table-loading {
    text-align: center;
    padding: 50px;
    color: #666;
}

.no-data {
    text-align: center;
    padding: 50px;
    color: #666;
}
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-container">
            <img class="logo" src="../../frontend/images/logo/Logo-group.png" alt="logo">
        </div>
        
        <a href="../../app/homepage.php" class="menu-item">
            <i class="fas fa-home"></i>
            Home
        </a>
        
        <div class="has-submenu">
            <a href="#" class="menu-item">
                <i class="fas fa-clipboard-list"></i>
                Management
                <i class="fas fa-chevron-down submenu-icon rotate-icon"></i>
            </a>
            <div class="submenu submenu-open">
                <a href="../../management/data_customer/index.php" class="submenu-item active">Data Consumer Management</a>
                <a href="../../management/data_sparepart/index.php" class="submenu-item">Data Sparepart Management</a>
            </div>
        </div>
        
        <a href="../../inventory/index.php" class="menu-item">
            <i class="fas fa-boxes"></i>
            Inventory
        </a>
        
        <a href="../../app/repair.php" class="menu-item">
            <i class="fas fa-wrench"></i>
            Repair Service
        </a>
        
        <a href="../../app/help.php" class="menu-item">
            <i class="fas fa-question-circle"></i>
            Help
        </a>
        
        <a href="../../app/myaccount.php" class="menu-item">
            <i class="fas fa-user"></i>
            My Account
        </a>
    </div>
    
    <div class="main-content">
        <div class="header">
            <h1>Data Consumer Management</h1>
            <div class="user-info">
                <span class="email">Leopoldobenavent@reangel.com</span>
                <div class="user-icon">
                    <i class="fas fa-user"></i>
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
                    <div class="settings-icon">
                        <i class="fas fa-sliders-h"></i>
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
                    <tbody id="tableBody">
                        <tr class="table-loading">
                            <td colspan="9">
                                <i class="fas fa-spinner fa-spin"></i> Loading data...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add/Edit Customer Modal -->
    <div id="editModal" class="modal-overlay">
        <div class="edit-modal">
            <h2 class="modal-title">Edit Customer</h2>
            <button class="close-btn">&times;</button>
            
            <form id="editCustomerForm">
                <input type="hidden" id="customerId" value="">
                
                <div class="form-group">
                    <label for="name">Name <span class="required">*</span></label>
                    <input type="text" id="name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="contact">Contact <span class="required">*</span></label>
                    <input type="text" id="contact" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="lastVisit">Date of Last Visit</label>
                    <input type="date" id="lastVisit" class="form-control date-input">
                </div>
                
                <div class="form-group">
                    <label for="repairService">Repair Service</label>
                    <textarea id="repairService" class="form-control" placeholder="Enter repair service details"></textarea>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" placeholder="Enter detailed description of the service or repair"></textarea>
                </div>

                <div class="form-group">
                    <label for="progress">Progress Status</label>
                    <select id="progress" class="form-control">
                        <option value="in-progress">In Progress</option>
                        <option value="complete">Complete</option>
                    </select>
                </div>
                
                <div class="btn-container">
                    <button type="button" class="btn btn-save" id="saveBtn">Save</button>
                    <button type="button" class="btn btn-cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay" style="display: none;">
        <div class="loading-spinner">
            <i class="fas fa-spinner fa-spin"></i>
            <p>Processing...</p>
        </div>
    </div>

    <script>
        // Global variables
        let isEditMode = false;
        let currentEditingId = null;
        let allCustomers = [];

        // DOM elements
        const modal = document.getElementById('editModal');
        const addCustomerBtn = document.getElementById('addCustomerBtn');
        const closeBtn = document.querySelector('.close-btn');
        const saveBtn = document.getElementById('saveBtn');
        const cancelBtn = document.querySelector('.btn-cancel');
        const modalTitle = document.querySelector('.modal-title');
        const editForm = document.getElementById('editCustomerForm');
        const loadingOverlay = document.getElementById('loadingOverlay');
        const tableBody = document.getElementById('tableBody');
        const searchInput = document.getElementById('searchInput');

        // Form fields
        const customerIdField = document.getElementById('customerId');
        const nameField = document.getElementById('name');
        const contactField = document.getElementById('contact');
        const addressField = document.getElementById('address');
        const lastVisitField = document.getElementById('lastVisit');
        const repairServiceField = document.getElementById('repairService');
        const descriptionField = document.getElementById('description');
        const progressField = document.getElementById('progress');

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            loadCustomers();
            attachEventListeners();
        });

        // Attach event listeners
        function attachEventListeners() {
            addCustomerBtn.addEventListener('click', openAddCustomerModal);
            closeBtn.addEventListener('click', closeModal);
            cancelBtn.addEventListener('click', closeModal);
            saveBtn.addEventListener('click', handleSaveCustomer);
            searchInput.addEventListener('input', handleSearch);
            
            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
            
            // Prevent form submission
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();
            });
        }

        // Load customers from database
        async function loadCustomers() {
            try {
                showLoading();
                const response = await fetch('../../../backend/db/add_customer.php');
                const result = await response.json();
                
                hideLoading();
                
                if (result.success) {
                    allCustomers = result.data;
                    displayCustomers(allCustomers);
                } else {
                    console.error('Error loading customers:', result.message);
                    showError('Failed to load customers: ' + result.message);
                }
            } catch (error) {
                hideLoading();
                console.error('Error loading customers:', error);
                showError('Failed to load customers. Please check your connection.');
            }
        }

        // Display customers in table
        function displayCustomers(customers) {
            if (customers.length === 0) {
                tableBody.innerHTML = `
                    <tr class="no-data">
                        <td colspan="9">No customers found</td>
                    </tr>
                `;
                return;
            }

            tableBody.innerHTML = customers.map((customer, index) => {
                const displayDate = customer.date_last_visit ? formatDate(customer.date_last_visit) : '';
                const truncatedAddress = truncateText(customer.address || '', 12);
                const truncatedDescription = truncateText(customer.description || '', 30);
                const statusClass = customer.progress === 'complete' ? 'complete' : 'in-progress';
                const statusText = customer.progress === 'complete' ? 'Complete' : 'In Progress';

                return `
                    <tr data-id="${customer.id}">
                        <td>${index + 1}.</td>
                        <td>${escapeHtml(customer.name)}</td>
                        <td>${escapeHtml(customer.contact)}</td>
                        <td class="truncate" title="${escapeHtml(customer.address || '')}">${escapeHtml(truncatedAddress)}</td>
                        <td>${displayDate}</td>
                        <td>${escapeHtml(customer.repair_service || '')}</td>
                        <td class="truncate" title="${escapeHtml(customer.description || '')}">${escapeHtml(truncatedDescription)}</td>
                        <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                        <td>
                            <button class="action-btn edit" onclick="openEditCustomerModal(${customer.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-btn delete" onclick="deleteCustomer(${customer.id})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // Handle search
        function handleSearch() {
            const searchTerm = searchInput.value.toLowerCase();
            if (!searchTerm) {
                displayCustomers(allCustomers);
                return;
            }

            const filteredCustomers = allCustomers.filter(customer => {
                return customer.name.toLowerCase().includes(searchTerm) ||
                       customer.contact.toLowerCase().includes(searchTerm) ||
                       (customer.address && customer.address.toLowerCase().includes(searchTerm)) ||
                       (customer.repair_service && customer.repair_service.toLowerCase().includes(searchTerm)) ||
                       (customer.description && customer.description.toLowerCase().includes(searchTerm));
            });

            displayCustomers(filteredCustomers);
        }

        // Open modal for adding new customer
        function openAddCustomerModal() {
            isEditMode = false;
            currentEditingId = null;
            modalTitle.textContent = 'Add Customer';
            clearForm();
            modal.style.display = 'flex';
        }

        // Open modal for editing existing customer
        function openEditCustomerModal(customerId) {
            const customer = allCustomers.find(c => c.id == customerId);
            if (!customer) {
                showError('Customer not found');
                return;
            }

            isEditMode = true;
            currentEditingId = customerId;
            modalTitle.textContent = 'Edit Customer';
            populateForm(customer);
            modal.style.display = 'flex';
        }

        // Close modal
        function closeModal() {
            modal.style.display = 'none';
            clearForm();
            isEditMode = false;
            currentEditingId = null;
        }

        // Clear form fields
        function clearForm() {
            customerIdField.value = '';
            nameField.value = '';
            contactField.value = '';
            addressField.value = '';
            lastVisitField.value = '';
            repairServiceField.value = '';
            descriptionField.value = '';
            progressField.value = 'in-progress';
        }

        // Populate form with customer data
        function populateForm(customer) {
            customerIdField.value = customer.id;
            nameField.value = customer.name || '';
            contactField.value = customer.contact || '';
            addressField.value = customer.address || '';
            lastVisitField.value = customer.date_last_visit || '';
            repairServiceField.value = customer.repair_service || '';
            descriptionField.value = customer.description || '';
            progressField.value = customer.progress || 'in-progress';
        }

        // Handle save customer
        async function handleSaveCustomer() {
            // Validate required fields
            if (!nameField.value.trim() || !contactField.value.trim()) {
                showError('Name and Contact are required fields');
                return;
            }

            const customerData = {
                name: nameField.value.trim(),
                contact: contactField.value.trim(),
                address: addressField.value.trim(),
                date_last_visit: lastVisitField.value || null,
                repair_service: repairServiceField.value.trim(),
                description: descriptionField.value.trim(),
                progress: progressField.value || 'in-progress'
            };

            if (isEditMode) {
                customerData.id = currentEditingId;
            }

            try {
                showLoading();
                
                const url = isEditMode ? 'update_customer.php' : 'add_customer.php';
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(customerData)
                });

                const result = await response.json();
                hideLoading();

                if (result.success) {
                    closeModal();
                    await loadCustomers(); // Reload data from database
                    showSuccessMessage(isEditMode ? 'Customer updated successfully' : 'Customer added successfully');
                } else {
                    showError('Error: ' + result.message);
                }
            } catch (error) {
                hideLoading();
                console.error('Error saving customer:', error);
                showError('Error saving customer. Please try again.');
            }
        }

        // Delete customer
        async function deleteCustomer(customerId) {
            if (!confirm('Are you sure you want to delete this customer?')) {
                return;
            }

            try {
                showLoading();
                
                const response = await fetch('../../../backend/db/add_customer.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: customerId })
                });

                const result = await response.json();
                hideLoading();

                if (result.success) {
                    await loadCustomers(); // Reload data from database
                    showSuccessMessage('Customer deleted successfully');
                } else {
                    showError('Error deleting customer: ' + result.message);
                }
            } catch (error) {
                hideLoading();
                console.error('Error deleting customer:', error);
                showError('Error deleting customer. Please try again.');
            }
        }

        // Utility functions
        function showLoading() {
            loadingOverlay.style.display = 'flex';
        }

        function hideLoading() {
            loadingOverlay.style.display = 'none';
        }

        function showSuccessMessage(message) {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background-color: #4CAF50;
                color: white;
                padding: 15px 20px;
                border-radius: 5px;
                z-index: 10000;
                box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            `;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 3000);
        }

        function showError(message) {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background-color: #f44336;
                color: white;
                padding: 15px 20px;
                border-radius: 5px;
                z-index: 10000;
                box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            `;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 5000);
        }

        function formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }

        function truncateText(text, maxLength) {
            if (!text || text.length <= maxLength) return text;
            return text.substring(0, maxLength) + '...';
        }

        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    </script>
</body>
</html>