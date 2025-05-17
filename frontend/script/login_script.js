// Untuk melihat dan menyembunyikan password
document.getElementById('toggle-password').addEventListener('click', function() {
    const passwordField = document.getElementById('password-field');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.querySelector('svg').style.fill = type === 'password' ? '#666' : '#007bff';
});

const form = document.getElementById('login-form');
const usernameInput = form.querySelector('input[name="username"]');
const passwordInput = form.querySelector('input[name="password"]');
const signInBtn = form.querySelector('.signin-btn');
const errorMessage = document.getElementById('error-message');

form.addEventListener('submit', async function(e) {
e.preventDefault();

// Reset error styles
usernameInput.classList.remove('input-error');
passwordInput.classList.remove('input-error');
signInBtn.classList.remove('button-error');
errorMessage.textContent = '';

let hasError = false;

if (!usernameInput.value.trim()) {
    usernameInput.classList.add('input-error');
    hasError = true;
}

if (!passwordInput.value.trim()) {
    passwordInput.classList.add('input-error');
    hasError = true;
}

if (hasError) {
    signInBtn.classList.add('button-error');
    errorMessage.textContent = 'Username dan password wajib diisi.';
    return;
}

// Kirim data login ke PHP
const formData = new FormData(form);

try {
    const response = await fetch('../../backend/db/login_db.php', {
    method: 'POST',
    body: formData,
    });

    const result = await response.json();

    if (result.success) {
    // Login berhasil, redirect
    window.location.href = result.redirect || 'homepage.php';
    } else {
    // Login gagal, kasih tanda merah
    errorMessage.textContent = result.message || 'Username atau password salah!';
    usernameInput.classList.add('input-error');
    passwordInput.classList.add('input-error');
    signInBtn.classList.add('button-error');
    }
} catch (error) {
    alert('Terjadi kesalahan jaringan.');
    console.error(error);
}
});
