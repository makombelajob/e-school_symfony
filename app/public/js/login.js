document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const emailInput = document.querySelector('#username');
    const passwordInput = document.querySelector('#password');
    const submitButton = form.querySelector('button[type="submit"]');

    const validateEmail = email => email && email.includes('@');
    const validatePassword = password => password.trim() !== '';

    const showSuccessMessage = () => {
        const container = form.parentElement;
        const successDiv = document.createElement('div');
        successDiv.className = 'alert alert-success text-center my-3';
        successDiv.textContent = 'Vous êtes connecté ✅';
        container.replaceChild(successDiv, form);
    };

    const showError = (input, message) => {
        let errorDiv = input.parentElement.querySelector('.invalid-feedback') || 
            Object.assign(document.createElement('div'), { className: 'invalid-feedback' });
        if (!errorDiv.parentElement) input.parentElement.appendChild(errorDiv);
        errorDiv.textContent = message || '';
        input.classList.toggle('is-invalid', !!message);
    };

    const validateInput = () => {
        const email = emailInput.value;
        const password = passwordInput.value;
        const emailError = email && !validateEmail(email) ? "Merci de saisir une adresse e-mail correcte 'avec - @'" : 
                           !email ? "Ce champ est requis" : '';
        const passwordError = !validatePassword(password) ? "Ce champ est requis" : '';
        
        showError(emailInput, emailError);
        showError(passwordInput, passwordError);
        submitButton.disabled = emailError || passwordError;
    };

    emailInput.addEventListener('input', validateInput);
    passwordInput.addEventListener('input', validateInput);

    form.addEventListener('submit', e => {
        e.preventDefault();
        const email = emailInput.value;
        const password = passwordInput.value;
        if (validateEmail(email) && validatePassword(password)) {
            showSuccessMessage();
        } else {
            validateInput();
        }
    });
});