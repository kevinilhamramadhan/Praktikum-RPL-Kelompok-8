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