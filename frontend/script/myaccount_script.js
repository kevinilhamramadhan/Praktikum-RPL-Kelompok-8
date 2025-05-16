document.addEventListener('DOMContentLoaded', function() {
    // Submenu toggle
    const hasSubmenu = document.querySelector('.has-submenu');
    const submenuIcon = document.querySelector('.submenu-icon');
    const submenu = document.querySelector('.submenu');
    
    if (hasSubmenu && submenuIcon && submenu) {
        hasSubmenu.addEventListener('click', function(e) {
            if (e.target.closest('.submenu-item')) return;
            e.preventDefault();
            submenu.classList.toggle('submenu-open');
            submenuIcon.classList.toggle('rotate-icon');
        });
    }

    // Toggle dark mode
    const toggleSwitchInput = document.querySelector('.toggle-switch input');
    if (toggleSwitchInput) {
        toggleSwitchInput.addEventListener('change', function() {
            console.log('Dark mode toggled:', this.checked);
        });
    }

    // Activity item clicks
    document.querySelectorAll('.activity-item').forEach(item => {
        item.addEventListener('click', function() {
            console.log('Activity clicked:', this.querySelector('span').textContent);
        });
    });

    // Fetch profile data
fetch('../../backend/app/myaccount.php', {
    credentials: 'include'
})
    
  .then(response => response.text())  // ambil sebagai teks dulu
  .then(text => {
    console.log('Response text:', text);  // lihat output di console
    try {
      const data = JSON.parse(text);
      if (!data.error) {
        document.getElementById('username').textContent = data.username;
        document.getElementById('email').textContent = data.email;
        document.getElementById('jabatan').textContent = data.jabatan;
        document.getElementById('avatar').src = data.photo;
      } else {
        document.getElementById('username').textContent = "Error loading profile";
      }
    } catch(e) {
      console.error('JSON parse error:', e);
      document.getElementById('username').textContent = "Error parsing data";
    }
  })
  .catch(err => {
    document.getElementById('username').textContent = "Error fetching data";
    console.error(err);
  });

});
