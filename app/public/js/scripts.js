function slideInterval() {

    // Récupère l'élément avec l'id 'carousel' dans le DOM
    const slide = document.querySelector('#carousel');

    // Initialise un carrousel Bootstrap sur cet élément
    const carousel = new bootstrap.Carousel(slide);

    // Lance un intervalle pour passer automatiquement à la diapositive suivante toutes les 3 secondes
    let interval = setInterval(() => {
        carousel.next();
    }, 3000);

    // Met en pause le carrousel lorsque la souris passe dessus
    slide.addEventListener("mouseenter", function () {
        clearInterval(interval);
    });

    // Relance le carrousel lorsque la souris quitte l'élément
    slide.addEventListener("mouseleave", function () {
        interval = setInterval(() => {
            carousel.next();
        }, 3000);
    });
}

function formContact() {
    let emailValid = subjectValid = messageValid = gpdrValid = false;
    const btnSubmit = document.querySelector("#contacts_form_envoyer");


    function toutValid() {
        btnSubmit.disabled = !(emailValid && subjectValid && messageValid && gpdrValid);
    }

    const email = document.querySelector("#contacts_form_email");
    email.addEventListener("change", function () {
        const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!regex.test(email.value)) {
            this.classList.add("is-invalid");
            this.classList.remove("is-valid");
            emailValid = false;
        } else {
            this.classList.remove("is-invalid");
            this.classList.add("is-valid");
            emailValid = true;
        }
        toutValid();
    });

    const subject = document.querySelector("#contacts_form_subject");
    subject.addEventListener("change", function () {
        if (subject.value.length < 5 || subject.value.length > 100) {
            this.classList.add("is-invalid");
            this.classList.remove("is-valid");
            subjectValid = false;
        } else {
            this.classList.add("is-valid");
            this.classList.remove("is-invalid");
            subjectValid = true;
        }
        toutValid();
    });

    const message = document.querySelector("#contacts_form_message");
    message.addEventListener("change", function () {
        if (message.value.length <= 5) {
            this.classList.add("is-invalid");
            this.classList.remove("is-valid");
            messageValid = false;
        } else {
            this.classList.add("is-valid");
            this.classList.remove("is-invalid");
            messageValid = true;
        }
        toutValid();
    });

    const gpdr = document.querySelector("#contacts_form_agreeTerms");
    gpdr.addEventListener("change", function () {
        if (!gpdr.checked) {
            this.classList.add("is-invalid");
            this.classList.remove("is-valid");
            gpdrValid = false;
        } else {
            this.classList.remove("is-invalid");
            this.classList.add("is-valid");
            gpdrValid = true;
        }
        toutValid();
    });

    const form = document.querySelector("#contactForm");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        if (emailValid && subjectValid && messageValid && gpdrValid) {
            btnSubmit.removeAttribute("disabled");
            form.submit();
        } else {
            const evenement = new Event("change");
            email.dispatchEvent(evenement);
            subject.dispatchEvent(evenement);
            message.dispatchEvent(evenement);
            gpdr.dispatchEvent(evenement);
        }
    });
}
// Appelle la fonction pour activer le carrousel avec l'intervalle défini
slideInterval();
formContact();