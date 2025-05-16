// Toggle password visibility
document.getElementById('toggle-password').addEventListener('click', function() {
    const passwordField = document.getElementById('password-field');
    passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
});

// Make checkbox clickable
document.querySelector('.checkbox').addEventListener('click', function() {
    this.style.backgroundColor = this.style.backgroundColor === 'rgb(23, 194, 77)' ? 'transparent' : '#17c24d';
});


