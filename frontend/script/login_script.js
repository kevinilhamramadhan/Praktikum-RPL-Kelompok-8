document.getElementById('toggle-password').addEventListener('click', function() {
    const passwordField = document.getElementById('password-field');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Optional: change icon color
    this.querySelector('svg').style.fill = type === 'password' ? '#666' : '#007bff';
});

