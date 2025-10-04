document.addEventListener('DOMContentLoaded', () => {
    // Sélection des éléments
    const form = document.querySelector('form');
    const inputs = {
        email: document.querySelector('#registration_form_email'),
        password: document.querySelector('#registration_form_plainPassword'),
        lastname: document.querySelector('#registration_form_lastname'),
        firstname: document.querySelector('#registration_form_firstname'),
        agreeTerms: document.querySelector('#registration_form_agreeTerms')
    };
    const submitButton = form.querySelector('button[type="submit"]');

    // Messages d'erreur
    const errors = {
        email: "Merci de saisir une adresse e-mail correcte 'avec - @'",
        password: 'Le mot de passe doit contenir au moins 8 caractères, un caractère spécial et un chiffre',
        required: 'Ce champ est requis',
        terms: 'Vous devez accepter les conditions d\'utilisation'
    };

    // Fonctions de validation
    const validate = {
        email: value => value.includes('@'),
        password: value => /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value),
        lastname: value => value.trim() !== '',
        firstname: value => value.trim() !== '',
        agreeTerms: checked => checked
    };

    // Mettre à jour l'état du bouton
    const updateButton = () => {
        // Validation explicite pour chaque champ
        const isValid = (
            validate.email(inputs.email.value) &&
            validate.password(inputs.password.value) &&
            validate.lastname(inputs.lastname.value) &&
            validate.firstname(inputs.firstname.value) &&
            validate.agreeTerms(inputs.agreeTerms.checked)
        );
        submitButton.disabled = !isValid;
        submitButton.classList.toggle('btn-secondary', !isValid);
        submitButton.classList.toggle('btn-success', isValid);
    };

    // Afficher/masquer les erreurs
    const showError = (input, message) => {
        let errorDiv = input.parentElement.querySelector('.invalid-feedback');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.classList.add('invalid-feedback');
            input.parentElement.appendChild(errorDiv);
        }
        errorDiv.textContent = message || '';
        input.classList.toggle('is-invalid', !!message);
    };

    // Valider un champ
    const validateInput = (key) => {
        const input = inputs[key];
        const isCheckbox = key === 'agreeTerms';
        const value = isCheckbox ? input.checked : input.value;
        let error = '';
        if (isCheckbox && !value) error = errors.terms;
        else if ((key === 'lastname' || key === 'firstname') && !validate[key](value)) error = errors.required;
        else if ((key === 'email' || key === 'password') && !value) error = errors.required;
        else if ((key === 'email' || key === 'password') && value && !validate[key](value)) error = errors[key];
        showError(input, error);
        updateButton();
    };

    // Ajouter les écouteurs
    Object.entries(inputs).forEach(([key, input]) => {
        input.addEventListener(key === 'agreeTerms' ? 'change' : 'input', () => validateInput(key));
    });

    // Validation à la soumission
    form.addEventListener('submit', e => {
        let hasError = false;
        Object.keys(inputs).forEach(key => {
            validateInput(key);
            if (inputs[key].parentElement.querySelector('.invalid-feedback')?.textContent) hasError = true;
        });
        if (hasError) e.preventDefault();
    });

    // Initialisation
    submitButton.disabled = true;
    submitButton.classList.add('btn-secondary');
    submitButton.classList.remove('btn-success');
    Object.keys(inputs).forEach(key => validateInput(key));
});