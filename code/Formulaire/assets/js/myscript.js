document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault(); // Empêche la soumission normale du formulaire

    const formData = new FormData(this);

    fetch('traitement.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            const container = document.querySelector('.contact-clean');
            container.innerHTML = ''; // Vide le contenu actuel

            const messageDiv = document.createElement('div');
            messageDiv.className = 'alert';
            messageDiv.innerText = data.message;

            if (data.status === 'success') {
                messageDiv.classList.add('alert-success');
            } else {
                messageDiv.classList.add('alert-danger');
            }

            container.appendChild(messageDiv); // Ajoute le message au DOM
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
});
