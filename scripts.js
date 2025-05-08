// Przykład sprawdzenia, czy hasła są takie same podczas rejestracji
document.querySelector('form').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        event.preventDefault();
        alert("Hasła się nie zgadzają. Spróbuj ponownie.");
    }
});
