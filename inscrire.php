<?php
session_start();
require_once 'db.php';
$_SESSION['Id'] = $userRow['Id'];  // Stocke l'ID utilisateur
$_SESSION['Nom'] = $userRow['Nom']; // Stocke le nom d'utilisateur
// Connexion à la base de données


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["age"])&& !empty($_POST["sexe"]) &&
    !empty($_POST["telephone"]) &&!empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["passwor"])) {

        // Récupération et sécurisation des données
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $age = intval($_POST["age"]);
        $sexe = htmlspecialchars($_POST["sexe"]);
        $telephone = intval($_POST["telephone"]); 
        $email = htmlspecialchars($_POST["email"]);
        $username = htmlspecialchars($_POST["username"]);
        $password = password_hash($_POST["passwor"], PASSWORD_DEFAULT); // Hash du mot de passe

        // Vérifier si l'email existe déjà
        $checkEmail = $pdo->prepare("SELECT ID FROM utilisateurs WHERE Email = :email");
        $checkEmail->bindParam(":email", $email);
        $checkEmail->execute();

        if ($checkEmail->rowCount() > 0) {
            echo "<script>alert('Cet email est déjà utilisé.'); window.location.href='inscrire.html';</script>";
            exit();
        }

        // Insérer l'utilisateur
        $sql = "INSERT INTO utilisateurs (Nom, Prenom, Age,Sexe,Telephone, Email,Nom_utilisateur, Mot_de_passe) 
                VALUES (:nom, :prenom, :age,:sexe, :telephone,:email, :username,:passwor)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":age", $age);
        $stmt->bindParam(":sexe", $sexe);
        $stmt->bindParam(":telephone", $telephone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":passwor", $password);

        if ($stmt->execute()) {
            echo "<script>alert('Inscription réussie !'); window.location.href='accueil.php';</script>";
            header("Location: accueil.php");
    
            exit();
        } else {
            echo "<script>alert('Erreur lors de l\'inscription.'); window.location.href='inscrire.html';</script>";
        }
    } else {
        echo "<script>alert('Veuillez remplir tous les champs.'); window.location.href='inscrire.html';</script>";
    }
} else {
    echo "<script>alert('Méthode non autorisée.'); window.location.href='inscrire.html';</script>";
}


              
                ?>


