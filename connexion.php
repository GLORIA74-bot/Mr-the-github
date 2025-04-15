<?php
session_start();
require_once 'db.php';

// Récupération des données du formulaire
$username = trim($_POST['username']);
$password = $_POST['password']; // Mot de passe en clair saisi par l'utilisateur

// Requête pour récupérer l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE Nom_utilisateur = ?");
$stmt->execute([$username]);
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

if ($userRow) {
    var_dump($userRow['Mot_de_passe']);
    var_dump($password);
    // Vérifier le mot de passe haché stocké (ici la colonne s'appelle 'password')
    if (password_verify($password, $userRow['Mot_de_passe'])) {
        $_SESSION['username'] = $userRow['Nom_utilisateur'];
        echo "Connexion réussie !";
        header("Location: index.php");
        exit;
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
} else {
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}

   
?>
