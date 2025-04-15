
    document.addEventListener("DOMContentLoaded", function () {
        var cartList = document.getElementById("cart-list");
        var cartTotal = document.getElementById("cart-total");
        var cartCount = document.getElementById("cart-count");
    
        function updateCartDisplay() {
            var cart = JSON.parse(localStorage.getItem("cart")) || [];
            cartList.innerHTML = "";
            var totalAmount = 0;
    
            cart.forEach(function (item, index) {
                var li = document.createElement("li");
                li.innerHTML = item.quantity + " " + item.name + " - " + item.total + " FCFA " +
                    '<button class="remove-item" data-index="' + index + '">❌</button>';
                cartList.appendChild(li);
                totalAmount += item.total;
            });
    
            cartTotal.textContent = "Total : " + totalAmount + " FCFA";
            cartCount.textContent = cart.length;
        }
    
        updateCartDisplay();
    
        document.getElementById("clear-cart").addEventListener("click", function () {
            localStorage.removeItem("cart");
            updateCartDisplay();
        });
    
        document.addEventListener("click", function (event) {
            if (event.target.classList.contains("remove-item")) {
                var cart = JSON.parse(localStorage.getItem("cart")) || [];
                var index = event.target.getAttribute("data-index");
                cart.splice(index, 1);
                localStorage.setItem("cart", JSON.stringify(cart));
                updateCartDisplay();
            }
        });
    
        document.querySelector(".cart-button").addEventListener("click", function () {
            var dropdown = document.querySelector(".cart-dropdown");
            dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
        });
    });

    const searchInput = document.getElementById("search");
    searchInput.addEventListener("focus", function() {
        this.style.backgroundColor = "#fff";
    });
    searchInput.addEventListener("blur", function() {
        this.style.backgroundColor = "";
    });

    const menuItems = document.querySelectorAll(".menu-item");
    const menuContent = document.getElementById("menu-content");
    const submenuList = document.getElementById("submenu-list");
    const imageContainer = document.getElementById("image-container");
    
    const categories = {
        cafe: {
            images: ["img/latte.jpg", "img/aaaa.jpg"], 
            hoverImages: ["img/aaaa.jpg", "img/latte.jpg"],
            texts: ["Profitez d'un café intense", "Goûtez notre café doux"],
            sublinks: ["Espresso", "Latte", "Cappuccino", "Macchiato", "Moka", "Americano"]
        },
        the: {
            images: ["img2/per.jpg", "img2/R.jpg"],
            hoverImages: ["img2/R.jpg", "img2/per.jpg"],
            texts: ["Découvrez notre thé vert", "Détendez-vous avec du thé noir"],
            sublinks: ["Thé Vert au lait", "Thé au lait", "Thé au jelly", "Thé vert à la fraise", "Thé à la mangue", "Thé à la menthe"]
        },
        smoothie: {
            images: ["img3/bn.jpg", "img3/bn.jpg"],
            hoverImages: ["img3/bn.jpg", "img3/bn.jpg"],
            texts: ["Savourez un smoothie frais", "Boostez votre énergie"],
            sublinks: ["Fraise", "Mangue", "Banane", "Fruits Rouges", "Papaye", "Avocat"]
        },
        Specialites: {
            images: ["img4/tc.jpg", "img4/cr.jpg"],
            hoverImages: ["img4/cr.jpg", "img4/tc.jpg"],
            texts: ["Un dessert chaud réconfortant", "Dégustez notre chocolat épicé"],
            sublinks: ["Gauffre au chocolat", "Crème à la vanille", "Pancake à la fraise", "Thé chaud au chocolat", "Crêpe au chocolat", "Cocktail de fruits"]
        }
    };
    menuItems.forEach(item => {
        item.addEventListener("mouseenter", function() {
            const category = this.getAttribute("data-category");
            submenuList.innerHTML = ""; 
            imageContainer.innerHTML = ""; 
    
            categories[category].sublinks.forEach(sub => {
                const li = document.createElement("li");
                li.textContent = sub;
                submenuList.appendChild(li);
            });
    
            categories[category].images.forEach((imgSrc, index) => {
                const box = document.createElement("div");
                box.classList.add("image-box");
    
                const img = document.createElement("img");
                img.src = imgSrc;
                img.setAttribute("data-hover", categories[category].hoverImages[index]);
    
                img.addEventListener("mouseover", function() {
                    this.src = this.getAttribute("data-hover");
                });
    
                img.addEventListener("mouseout", function() {
                    this.src = imgSrc;
                });
    
                const text = document.createElement("div");
                text.classList.add("image-text");
                text.textContent = categories[category].texts[index];
    
                const button = document.createElement("button");
               
                button.classList.add("image-button");
                button.textContent = "Commandez";
               
    
                box.append(img, text, button);
                imageContainer.appendChild(box);
            });
    
            menuContent.style.display = "flex";
        });
    });
      
           
            document.addEventListener("click", function (event) {
                if (!menuContent.contains(event.target) && !event.target.classList.contains("menu-item")) {
                    menuContent.classList.remove("active");
                }
            }); 

    menuContent.addEventListener("mouseleave", function() {
        timeout = setTimeout(() => {
            menuContent.style.display = "none";
        }, 300); 
    });
            
           
        document.querySelectorAll(".preview-img").forEach(img => {
            img.addEventListener("mouseover", function() {
                this.dataset.original = this.src; 
                this.src = this.getAttribute("data-hover"); 
            });
        
            img.addEventListener("mouseout", function() {
                this.src = this.dataset.original; 
            });
        });
        
            categoryImage.addEventListener("mouseover", function() {
                this.src = this.getAttribute("data-hover");
            });
            
            categoryImage.addEventListener("mouseout", function() {
                this.src = categories[document.querySelector(".menu-item:hover").getAttribute("data-category")].image;
            });
            
            const menuTitle = document.getElementById("menu-title");
    
    menuItems.forEach(item => {
        item.addEventListener("mouseenter", function() {
            clearTimeout(timeout);
    
            const category = this.getAttribute("data-category");
            menuTitle.textContent = 'Mr ${category.charAt(0).toUpperCase() + category.slice(1)} vous offre';
        });
    });
    menuItems.forEach(item => {
        item.addEventListener("mouseenter", function() {
            console.log("Survol détecté :", this.getAttribute("data-category")); 
            menuContent.style.display = "flex";
        });
    });
  
  

   