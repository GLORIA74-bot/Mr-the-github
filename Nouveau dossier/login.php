<?php
session_start();

// Connexion à la base de données
$host = "localhost";
$user = "root"; // Remplace par ton utilisateur MySQL
$pass = ""; // Remplace par ton mot de passe MySQL
$dbname = "test_gestion";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer les données du formulaire
$username = $_POST['username'];
$password = $_POST['password'];

// Vérifier si l'utilisateur existe
$sql = "SELECT * FROM utilisateurs WHERE User = '$username' AND Mot_de_passe = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    header("Location: accueil.php"); // Redirige vers la page d'accueil
    exit();
} else {
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}
?>