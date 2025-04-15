/*document.addEventListener("DOMContentLoaded", function () {
    let form = document.getElementById("loginForm");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Empêche l'envoi du formulaire par défaut

        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;

        if (username && password) {
            localStorage.setItem("userLoggedIn", "true");
            localStorage.setItem("username", username);

            console.log("Utilisateur enregistré dans localStorage :", localStorage.getItem("username")); // Vérification

            alert("Connexion réussie !");
            window.location.href = "accueil.html"; // Redirection vers l'accueil
        } else {
            alert("Veuillez entrer un nom d'utilisateur et un mot de passe valides.");
        }
    });
});*/