<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: connecter.html");
    exit();
}
$username = $_SESSION['username'];

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
    <title>Mr thé</title>
    <link rel="stylesheet" href="accueil.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="accueil.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
       
</head>
<body>
    <div class="banniere-defilante" >
        <marquee behavior="alternate" direction="left" > <p >Bienvenue chez Mr Thé - Livraison partout H24</p></marquee>
     </div>
    <header>
        
        <nav>
            <ul class="menus">
                <li class="menus-item">
                    <button class="menus-button"><i class="fa-solid fa-bars"></i> Menu</button>
                    <ul class="submenus">
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="connecter.html">Se connecter</a></li>
                        <li><a href="inscrire.html">S'inscrire</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="search-container">
            <input type="text" placeholder="Rechercher..." id="search" autocomplete="off">
             <i class="fas fa-search"></i>
         
          
        </div>

        <h1 class="site-title"><span>MR THE AVEDJI</span></h1>
       
       
        <div class="action">
            <button class="login-button"><i class="fa-solid fa-user"></i><a href="connecter.html" id="aa">Se connecter</a> </button>
        </div>
       
    
            <div class="cart">
                <button class="cart-button"><i class="fa-solid fa-shopping-cart"></i> Panier</button>
                <span id="cart-count">0</span>
                <div class="cart-dropdown">
                    <ul id="cart-list"></ul>
                    <p id="cart-total"></p>
                    <button id="clear-cart">Vider le panier</button>
                </div>
            </div>
       
    </header>

    <div class="container">
    <h1> <?php echo htmlspecialchars($username); ?> !</h1>

    <div class="user-box" onclick="toggleMenu()">
        <?php echo htmlspecialchars($initiales); ?>
        <div class="dropdown" id="dropdownMenu">
            <a href="#">Changer de photo</a>
            <a href="deconnexion.php">Se déconnecter</a>
        </div>
    </div>
</div>

<script>
    function toggleMenu() {
        var menu = document.getElementById("dropdownMenu");
        menu.style.display = (menu.style.display === "block") ? "none" : "block";
    }
    document.addEventListener("click", function(event) {
        var userBox = document.querySelector(".user-box");
        var dropdown = document.getElementById("dropdownMenu");

        if (!userBox.contains(event.target)) {
            dropdown.style.display = "none";
        }
    });
</script>

   
    <!-- MENU PRINCIPAL -->
    <p class="horaires">Nous sommes ouverts tous les jours de 8h à 20h</p>
    <button class="consult" ><a href="consulter.html" id="aab">Consulter</a></button>    
    <nav class="menu">
        <div class="menu-item" data-category="cafe"><a href="café.html" id="aaa">Café</a></div>
        <div class="menu-item" data-category="the"><a href="the.html" id="aaa"> Thé </a></div>
        <div class="menu-item" data-category="smoothie"><a href="smoothie.html" id="aaa">Smoothie</a></div>
        <div class="menu-item" data-category="Specialites"><a href="choco.html" id="aaa">Specialites</a></div>
    </nav>
   

    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color:rgb(255, 255, 255); }
        .container { margin-top: 60px;  }
        
        /* Style du cadre des initiales */
        .user-box {
            display: inline-block;
            padding: 10px;
            background: black;
            border-radius: 50%;
            box-shadow: 3px 3px 10px gray;
            font-size: 20px;
            font-weight: bold;
            color: white;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            cursor: pointer;
            position: relative;
            margin-right: 1%;
        }
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
    <!-- CONTENU DU MENU -->
    <div class="menu-content" id="menu-content">
        <div class="menu-title" id="menu-title">Mr Thé vous offre</div>
        <div class="menu-title-line"></div> 
        <br>
        <div class="submenu">
            <ul id="submenu-list"></ul>
        </div>
        <div class="image-container" id="image-container"></div>
    </div>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="img/lat.jpg" alt="Image 1">
            <div class="overl"><h2>Bienvenue chez <span>Mr the</span></h2></div></div>

            <div class="swiper-slide"><img src="img/mok.jpg" alt="Image 2">
            <div class="overl"><h2>Bienvenue chez <span>Mr the</span></h2></div></div>

            <div class="swiper-slide"><img src="img/img9.jpg" alt="Image 3">
            <div class="overl"><h2>Bienvenue chez <span>Mr the</span></h2></div></div>

            <div class="swiper-slide"><img src="img4/te.jpg" alt="Image 4">
            <div class="overl"><h2>Bienvenue chez <span>Mr the</span></h2></div></div>
        </div>
    
        <!-- Pagination et boutons -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <section class="specialities">
    <div class="cards-container">
        <!-- Carte Spécialité -->
        <div class="card">
            <img src="img/ame.jpg" alt="Spécialité">
            <div class="card-content">
                <h2>Spécialité</h2>
                <p>Découvrez nos spécialités uniques, préparées avec passion.</p>
                <a href="café.html" class="btnn">Découvrir</a>
            </div>
        </div>
        <div class="card">
            <img src="img2/man.jpg" alt="Boissons">
            <div class="card-content">
                <h2>Boissons</h2>
                <p>Un large choix de boissons rafraîchissantes et savoureuses.</p>
                <a href="the.html" class="btnn">Découvrir</a>
            </div>
        </div>
    

    <div class="card">
        <img src="img3/mang.jpg" alt="Patisserie">
        <div class="card-content">
            <h2>Déluces</h2>
            <p>Succombez à nos smoothie artisanales, préparées avec amour et savoir-faire.</p>
            <a href="smoothie.html" class="btnn">Découvrir</a>
        </div>
    </div>
    </div>
</section>

<section class="cardd-sect">
    <div class="cardd-container">
<div class="cardd" style="margin-bottom: 12%;">
    <img src="img4/OIP.jpg" alt="Promotion">
    <div class="cardd-content">
        <h2>Promotion</h2>
        <p>Profitez de nos offres exclusives et savourez nos produits à prix réduits !</p>
        <div class="countdown">Offre se termine dans : <br>
            <span id="timer"></span></div>
        <a href="promo.html" class="btnn">Découvrir</a>
    </div>
    <div class="promo">Promo</div>
</div>
</div>

<div class="cardd">
    <img src="img5/c.jpg" alt="Chocolat">
    <div class="cardd-content">
        <h2>Chocolat</h2>
        <p>Profitez de nos meilleurs produits à base de chocolat !</p>
        
        <a href="chocolat.html" class="btnn">Découvrir</a>
    </div>
</div>
</div>

<div class="cardd">
    <img src="img/bb.jpg" alt="Combo">
    <div class="cardd-content">
        <h2>Special combo</h2>
        <p>Profitez de nos meilleurs combos!</p>
        <a href="combo.html" class="btnn">Découvrir</a>
    </div> 
</div>
</div>
</div>

</section>
<footer>
    <div class="footer-container">
        <!-- Section Contact -->
        <div class="footer-section contact">
            <h2 id="cont">Contact</h2>
           <p>Contact: <a href="">+228 91 84 22 13</a></p>
            <p>Email : <a href="mailto:senouablavigloria@gmail.com">senouablavigloria@gmail.com</a></p>
            <p>Nous sommes également à Zanguera,Sagbado,Novissi...</p> <button id="ab"><a href="https://maps.app.goo.gl/EG8fd8egrYY6RyXf9">Voir plus</a></button>
        </div>
        <!-- Section Suivez-nous -->
        <div class="footer-section follow-us">
            <h2>Suivez-nous</h2>
            <div class="social-icons">
                <a href="https://www.facebook.com/people/Monsieur-Th%C3%A9/100075443697842/" target="_blank" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.twitter.com" target="_blank" aria-label="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.pinterest.com" target="_blank" aria-label="Pinterest">
                    <i class="fab fa-pinterest-p"></i>
                </a>
                <a href="https://www.instagram.com/monsieurtheenafrique/" target="_blank" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
        
        <div class="footer-section useful-links">
            <h2>Liens Utiles</h2>
            <ul>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="https://quefairealome.com/kyrycafe-ou-monsieur-the/">Blog</a></li>
                <li><a href="confid.html">Politique de Confidentialité</a></li>
                <li><a href="offre.html">Offres</a></li>
            </ul>
        </div>
        
        <div class="footer-section payment-methods">
            <h2>Méthodes de Paiement</h2>
            <div class="payment-icons">
                <i class="fab fa-cc-visa" aria-label="Visa"></i>
                <i class="fab fa-cc-mastercard" aria-label="MasterCard"></i>
                <i class="fab fa-cc-paypal" aria-label="PayPal"></i>
                <i class="fab fa-cc-tmoney" aria-label="Tmoney"></i>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; Gloryys chou - Tous droits réservés</p>
    </div>
</footer>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let countdownDate = new Date();
        countdownDate.setDate(countdownDate.getDate() + 3); 

        function updateCountdown() {
            let now = new Date().getTime();
            let timeLeft = countdownDate - now;

            let days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            let hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            let timerElement = document.getElementById("timer");

            if (timerElement) {
                timerElement.innerHTML = days + "j " + hours + "h " + minutes + "m " + seconds + "s";
            }

            if (timeLeft < 0) {
                timerElement.innerHTML = "Offre expirée !";
            }
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();
    });
</script>
    <script>
        var swiper = new Swiper(".mySwiper", {
          effect: "slide",
          loop: true,
          grabCursor: true,
          centeredSlides: true,
          slidesPerView: "auto",
          autoplay: {
            delay: 3000, 
            disableOnInteraction: false,
          },
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
          zoom: {
            maxRatio: 1.2, 
          }
        });
      </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let header = document.querySelector("header");
        let banner = document.querySelector(".banner");
        let bannerHeight = banner ? banner.offsetHeight : 0; 

        window.addEventListener("scroll", function () {
            if (window.scrollY > bannerHeight) {
                header.classList.add("header-fixed");
                banner.style.display = "none"; 
            } else {
                header.classList.remove("header-fixed");
                banner.style.display = "flex"; 
            }
        });
    });
</script>
</body>
</html>