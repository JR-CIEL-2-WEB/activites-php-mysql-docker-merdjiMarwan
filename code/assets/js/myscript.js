function verifierFormulaire() {
    const champNom = document.querySelector('input[name="name"]');
    const champPrenom = document.querySelector('input[name="prénom"]');
    const champEmail = document.querySelector('input[name="email"]');
    const champMotDePasse = document.querySelector('input[name="password"]');
    const champMessage = document.querySelector('textarea[name="message"]');
    const champCheckbox = document.querySelector('#formCheck-1');
    const alerteMotDePasse = document.querySelector('small.text-danger');

    let formulaireValide = true;

    if (champNom.value.trim().length < 2) {
        champNom.style.borderColor = "red";
        formulaireValide = false;
    } else {
        champNom.style.borderColor = "green";
    }

    if (champPrenom.value.trim().length < 2) {
        champPrenom.style.borderColor = "red";
        formulaireValide = false;
    } else {
        champPrenom.style.borderColor = "green";
    }

    const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!regexEmail.test(champEmail.value.trim())) {
        champEmail.style.borderColor = "red";
        formulaireValide = false;
    } else {
        champEmail.style.borderColor = "green";
    }

    if (champMotDePasse.value.length < 8) {
        champMotDePasse.style.borderColor = "red";
        alerteMotDePasse.classList.remove("invisible");
        formulaireValide = false;
    } else {
        champMotDePasse.style.borderColor = "green";
        alerteMotDePasse.classList.add("invisible");
    }

    if (champMessage.value.trim() === "") {
        champMessage.style.borderColor = "red";
        formulaireValide = false;
    } else {
        champMessage.style.borderColor = "green";
    }

 
    const labelCheckbox = champCheckbox.nextElementSibling;
    if (!champCheckbox.checked) {
        labelCheckbox.style.color = "red";
        formulaireValide = false;
    } else {
        labelCheckbox.style.color = "green";
    }

    if (formulaireValide) {
        alert("Formulaire envoyé avec succès !");
    }
}
