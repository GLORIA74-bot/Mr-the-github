<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 
require_once 'db.php';
// Si installé avec Composer
// require 'PHPMailerAutoload.php'; // Si téléchargé manuellement

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $poste = $_POST['poste'];

    $mail = new PHPMailer(true);

    try {
        // Configuration SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Serveur SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'senouablavigloria@gmail.com'; // Remplace par ton email
        $mail->Password   = 'hkyr jfdf hsha kmib'; // Remplace par ton mot de passe ou un "mot de passe d'application"
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Expéditeur et destinataire
        $mail->setFrom($email, $nom);
        $mail->addAddress('senouablavigloria@gmail.com', 'Recrutement Entreprise');

       
        $mail->addAttachment($_FILES['cv']['tmp_name'], $_FILES['cv']['name']);
        $mail->addAttachment($_FILES['photo']['tmp_name'], $_FILES['photo']['name']);

      
        $mail->isHTML(true);
        $mail->Subject = "Candidature pour le poste de $poste";
        $mail->Body    = "<strong>Nom :</strong> $nom <br><strong>Email :</strong> $email <br><strong>Poste :</strong> $poste";

        $mail->send();
        echo "Candidature envoyée avec succès  Merciiiii!";
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi : {$mail->ErrorInfo}";
    }
}
?>