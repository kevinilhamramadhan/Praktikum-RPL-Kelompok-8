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

    // --- Edit profile toggle ---
    const editBtn = document.getElementById('edit-profile-btn');
    const editForm = document.getElementById('edit-profile-form');
    const cancelBtn = document.getElementById('cancel-edit-btn');
    const profileInfo = document.querySelector('.profile-info');

    if (editBtn && editForm && cancelBtn && profileInfo) {
        editBtn.addEventListener('click', () => {
            editBtn.style.display = 'none'; // sembunyikan tombol edit
            profileInfo.style.display = 'none';
            editForm.style.display = 'block';
        });

        cancelBtn.addEventListener('click', () => {
            editForm.style.display = 'none';
            profileInfo.style.display = 'flex'; // asumsi flex di awal
            editBtn.style.display = 'inline-block'; // tampilkan kembali tombol edit
        });
    }

    // --- Activity log ---
    document.querySelectorAll('.activity-item').forEach(item => {
        item.addEventListener('click', function () {
            console.log('Activity clicked:', this.querySelector('span').textContent);
        });
    });
});
