<?php
session_start();
require_once 'db.php';
// Vérifier si un token est présent dans l'URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    

    // Rechercher la demande de réinitialisation correspondant au token
    $stmt = $pdo->prepare("SELECT * FROM password_resets WHERE token = ?");
   
    $stmt->execute([$token]);
    $resetRequest = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resetRequest && strtotime($resetRequest['expires']) > time()) {
        // Le token est valide
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newPassword   = $_POST['password'];
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Mettre à jour le mot de passe de l'utilisateur dans la table utilisateurs
            $stmt = $pdo->prepare("UPDATE utilisateurs SET Mot_de_passe = ? WHERE Email = ?");
            $stmt->execute([$hashedPassword, $resetRequest['email']]);

            // Supprimer la demande de réinitialisation
            $stmt = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
            $stmt->execute([$token]);

            echo "Votre mot de passe a été réinitialisé avec succès.";
            exit;
        }
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Réinitialiser le mot de passe</title>
        </head>
        <body>
            <h2>Réinitialiser votre mot de passe</h2>
            <form action="reset_password.php" method="POST">
                <label for="password">Nouveau mot de passe :</label>
                <input type="password" name="password" required>
                <button type="submit">Réinitialiser</button>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Le lien de réinitialisation est invalide ou a expiré.";
    }
} else {
    echo "Lien invalide.";
}
?>