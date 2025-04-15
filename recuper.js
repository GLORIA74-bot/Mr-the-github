document.getElementById('resetForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const email = document.getElementById('email').value;
    
    // Validation du format de l'email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Veuillez entrer un email valide.");
        return;
    }

    // Simulation de l'envoi du lien de réinitialisation (en réalité, il faudrait intégrer avec un back-end)
    alert('Un lien pour réinitialiser votre mot de passe a été envoyé à votre email.');
    window.location.href = "connecter.html";
    // Ici, tu pourrais envoyer cet email à ton serveur pour qu'il envoie effectivement le lien de réinitialisation
    // Exemple : sendResetLinkToEmail(email);
    
    // Réinitialisation du formulaire
    document.getElementById('resetForm').reset();
});