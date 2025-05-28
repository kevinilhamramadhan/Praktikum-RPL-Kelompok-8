document.addEventListener('DOMContentLoaded', function () {
    // --- Submenu toggle ---
    const hasSubmenu = document.querySelector('.has-submenu');
    const submenuIcon = document.querySelector('.submenu-icon');
    const submenu = document.querySelector('.submenu');

    if (hasSubmenu && submenuIcon && submenu) {
        hasSubmenu.addEventListener('click', function (e) {
            if (e.target.closest('.submenu-item')) return;
            e.preventDefault();
            submenu.classList.toggle('submenu-open');
            submenuIcon.classList.toggle('rotate-icon');
        });
    }

    // --- Popup Edit Profile (Updated) ---
    const editBtn = document.getElementById('edit-profile-btn');
    const editForm = document.getElementById('edit-profile-form');
    const cancelBtn = document.getElementById('cancel-edit-btn');
    const popupOverlay = document.getElementById('popup-overlay');
    const closePopupBtn = document.getElementById('close-popup');
    const photoInput = document.getElementById('photo-input');
    const currentPhotoPreview = document.getElementById('current-photo-preview');

    // Show popup function
    function showPopup() {
        if (popupOverlay) {
            popupOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }
    }

    // Hide popup function
    function hidePopup() {
        if (popupOverlay) {
            popupOverlay.classList.remove('active');
            document.body.style.overflow = 'auto'; // Restore background scrolling
        }
    }

    // Edit button click - show popup
    if (editBtn) {
        editBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showPopup();
        });
    }

    // Close popup button
    if (closePopupBtn) {
        closePopupBtn.addEventListener('click', function(e) {
            e.preventDefault();
            hidePopup();
        });
    }

    // Cancel button
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            hidePopup();
        });
    }

    // Close popup when clicking outside the content
    if (popupOverlay) {
        popupOverlay.addEventListener('click', function(e) {
            if (e.target === popupOverlay) {
                hidePopup();
            }
        });
    }

    // Close popup with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && popupOverlay && popupOverlay.classList.contains('active')) {
            hidePopup();
        }
    });

    // Preview selected photo (if elements exist)
    if (photoInput && currentPhotoPreview) {
        photoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    currentPhotoPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Handle form submission with success message
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            // Form will submit normally to PHP backend
            // You can add loading state here if needed
            console.log('Profile form submitted');
            
            // Optional: Add loading indicator
            const submitBtn = editForm.querySelector('button[type="submit"]');
            if (submitBtn) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                submitBtn.disabled = true;
                
                // Re-enable after a short delay (form submission will redirect anyway)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            }
        });
    }

    // --- Activity log (existing functionality) ---
    document.querySelectorAll('.activity-item').forEach(item => {
        item.addEventListener('click', function () {
            console.log('Activity clicked:', this.querySelector('span').textContent);
        });
    });

    // --- Logout functionality (Updated) ---
    const logoutButton = document.getElementById('logoutButton');
    
    if (logoutButton) {
        logoutButton.addEventListener("click", async function(e) {
            e.preventDefault();
            
            // Show confirmation dialog
            if (confirm('Are you sure you want to logout?')) {
                try {
                    // Try the fetch method first
                    const res = await fetch("../../backend/db/logout.php", { 
                        method: "POST",
                        credentials: 'same-origin' 
                    });
                    
                    if (res.ok) {
                        window.location.href = "../app/login.php";
                    } else {
                        throw new Error('Logout request failed');
                    }
                } catch (error) {
                    console.error("Logout failed:", error);
                    // Fallback to direct navigation if fetch fails
                    window.location.href = "../../backend/db/logout.php";
                }
            }
        });
    }

    // --- Search functionality (if search elements exist) ---
    const searchInput = document.querySelector('.search-input');
    const searchBtn = document.querySelector('.search-btn');
    
    if (searchInput && searchBtn) {
        // Search button click
        searchBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const searchTerm = searchInput.value.trim();
            if (searchTerm) {
                console.log('Searching for:', searchTerm);
                // Add your search logic here
            }
        });

        // Search on Enter key
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const searchTerm = this.value.trim();
                if (searchTerm) {
                    console.log('Searching for:', searchTerm);
                    // Add your search logic here
                }
            }
        });
    }

    // --- Settings icon click (if exists) ---
    const settingsIcon = document.querySelector('.settings-icon');
    if (settingsIcon) {
        settingsIcon.addEventListener('click', function() {
            console.log('Settings clicked');
            // Add settings functionality here
        });
    }

    // --- Notification enable button (if exists) ---
    const enableBtn = document.querySelector('.enable-btn');
    if (enableBtn) {
        enableBtn.addEventListener('click', function() {
            console.log('Notification settings clicked');
            // Add notification settings logic here
        });
    }
});