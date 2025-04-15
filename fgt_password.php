<?php
// fgt_password.php

// Affichez toutes les erreurs pour le débogage (à désactiver en production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure les classes PHPMailer (vérifiez le chemin d'accès selon votre installation)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; 


// Configuration de la connexion à la base de données
require_once 'db.php';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);

    // Message générique pour ne pas révéler l'existence d'un compte
    $messageRetour = "Un lien de réinitialisation vous a été envoyé.";

    // Vérifier si l'email existe dans la table utilisateurs
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE Email = ?");
    $stmt->execute([$email]);
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userRow) {
        // Générer un token unique et définir une expiration (1 heure)
        $token   = bin2hex(random_bytes(16));
        $expires = date("Y-m-d H:i:s", time() + 3600);

        // Insérer la demande de réinitialisation dans la table password_resets
        $stmt = $pdo->prepare("INSERT INTO password_resets (email, token, expires) VALUES (:email, :token, :expires)");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":expires", $expires);
        // Construire le lien de réinitialisation
        // Remplacez "localhost/your_project_folder" par votre domaine ou le chemin correct en local
        $resetLink = "http://localhost/projet_Mr_the/reset_password.php?token=". urlencode($token);

        // Utilisation de PHPMailer pour envoyer l'email
        $mail = new PHPMailer(true);
        try {
            // Paramètres du serveur SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';             // Remplacez par votre serveur SMTP
            $mail->SMTPAuth   = true;
            $mail->Username   = 'senouablavigloria@gmail.com';         // Votre identifiant SMTP
            $mail->Password   ='hkyr jfdf hsha kmib';            // Votre mot de passe SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Ou PHPMailer::ENCRYPTION_SMTPS selon votre config
            $mail->Port       = 587;                              // Ou 465 selon votre configuration

            // Destinataires
            $mail->setFrom('senouablavigloria@gmail.com', 'MR THE');
            $mail->addAddress($email);

            // Contenu de l'email
            $mail->isHTML(true); // Email en texte brut (optionnel: true pour HTML)
            $mail->Subject = 'Reinitialisation de votre mot de passe';
            $mail->Body    = "Bonjour,\n\nPour reinitialiser votre mot de passe, cliquez sur le lien suivant (ou copiez-le dans votre navigateur) :\n\n"
                             . $resetLink . "\n\nCe lien expirera dans 1 heure.\n\nSi vous n'avez pas demandé cette réinitialisation, ignorez cet email.";

            $mail->send();
        } catch (Exception $e) {
            // En cas d'erreur, vous pouvez loguer $mail->ErrorInfo
            echo "L'envoi de l'email a échoué. Erreur: {$mail->ErrorInfo}";
        }
    }

    echo $messageRetour;
}
?>