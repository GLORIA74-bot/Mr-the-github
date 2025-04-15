<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: connexion.html");
    exit();
}

// Récupérer le nom de l'utilisateur
$username = $_SESSION['username'];

// Générer les initiales (première lettre de chaque mot du nom)
$words = explode(" ", $username);
$initiales = "";
foreach ($words as $word) {
    $initiales .= strtoupper($word[0]);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #f4f4f4; }
        .container { margin-top: 100px; }
        
        /* Style du cadre des initiales */
        .user-box {
            display: inline-block;
            padding: 15px;
            background: white;
            border-radius: 50%;
            box-shadow: 0px 0px 10px gray;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            width: 60px;
            height: 60px;
            line-height: 60px;
            text-align: center;
            cursor: pointer;
            position: relative;
        }

        /* Style du menu déroulant */
        .dropdown {
            display: none;
            position: absolute;
            top: 70px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            box-shadow: 0px 0px 10px gray;
            border-radius: 8px;
            width: 180px;
            text-align: center;
            overflow: hidden;
        }

        .dropdown a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            transition: 0.3s;
        }

        .dropdown a:hover {
            background: #ddd;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Bienvenue, <?php echo htmlspecialchars($username); ?> !</h1>

        <!-- Cadre des initiales avec menu déroulant -->
        <div class="user-box" onclick="toggleMenu()">
            <?php echo htmlspecialchars($initiales); ?>
            <div class="dropdown" id="dropdownMenu">
                <a href="#">Changer de photo</a>
                <a href="logout.php">Se déconnecter</a>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById("dropdownMenu");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }

        // Ferme le menu si on clique ailleurs
        document.addEventListener("click", function(event) {
            var userBox = document.querySelector(".user-box");
            var dropdown = document.getElementById("dropdownMenu");

            if (!userBox.contains(event.target)) {
                dropdown.style.display = "none";
            }
        });
    </script>

</body>
</html>