<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Aventures Sahariennes | Rajjel Agency</title>
    <link rel="stylesheet" href="aventure.css?v=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" id="theme-style">
    <script src="theme.js"></script>
    <style>
        /* Amélioration des styles pour les filtres */
        .filters-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
            padding: 20px;
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: var(--shadow);
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            min-width: 200px;
        }

        .filter-group label {
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-color);
        }

        .filter-select {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background-color: var(--white);
            transition: var(--transition);
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(230, 126, 34, 0.2);
        }

        #search-bar {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background-color: var(--white);
            transition: var(--transition);
        }

        #search-bar:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(230, 126, 34, 0.2);
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="acceuil1.php" class="logo">
                <img src="logofinal2.png" alt="Rajjel Agency">
            </a>
            <ul class="nav-menu">
                <li><a href="acceuil1.php">Accueil</a></li>
                <li><a href="aventure.php" class="active">Nos Treks</a></li>
                <li><a href="presentation.php">Présentation</a></li>
                <li><button id="theme-toggle" class="btn-nav">🎨 Thème</button></li>
                <li>
                    <select id="font-size-selector" class="btn-nav">
                        <option value="normal">Aa</option>
                        <option value="medium">Aa+</option>
                        <option value="large">Aa++</option>
                    </select>
                </li>

                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="profil.php" class="btn-nav">Mon Compte</a></li>
                <?php else: ?>
                    <li><a href="connexion.php" class="btn-nav">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-content">
            <h1>L'Appel du Désert</h1>
            <p>Découvrez nos expériences uniques à travers les plus beaux paysages sahariens</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <section class="treks-section">
                <h2 class="section-title">Nos Treks Exceptionnels</h2>
                <p class="section-subtitle">Vivez une aventure inoubliable dans le désert</p>

                <!-- Filtres et tris -->
                <div class="filters-container">
                    <div class="filter-group">
                        <label for="sort-by">Trier par :</label>
                        <select id="sort-by" class="filter-select">
                            <option value="default">Par défaut</option>
                            <option value="price-asc">Prix croissant</option>
                            <option value="price-desc">Prix décroissant</option>
                            <option value="duration-asc">Durée croissante</option>
                            <option value="duration-desc">Durée décroissante</option>
                            <option value="country">Pays</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="filter-duration">Durée :</label>
                        <select id="filter-duration" class="filter-select">
                            <option value="all">Toutes durées</option>
                            <option value="4">4 jours et plus</option>
                            <option value="5">5 jours et plus</option>
                            <option value="6">6 jours et plus</option>
                            <option value="7">7 jours</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="filter-country">Pays :</label>
                        <select id="filter-country" class="filter-select">
                            <option value="all">Tous pays</option>
                            <option value="Maroc">Maroc</option>
                            <option value="Algérie">Algérie</option>
                            <option value="Tunisie">Tunisie</option>
                            <option value="Égypte">Égypte</option>
                            <option value="Mauritanie">Mauritanie</option>
                            <option value="Mauritanie">Mali</option>
                            <option value="Mauritanie">Niger</option>
                            <option value="Mauritanie">Soudan</option>

                        </select>
                    </div>

                    <!-- Barre de recherche -->
                    <div class="filter-group">
                        <label for="search-bar">Rechercher :</label>
                        <input type="text" id="search-bar" class="filter-select" placeholder="Rechercher par mots-clés (ex : Maroc, désert)">
                    </div>
                </div>

                <div class="treks-grid">
                    <!-- Trek 1 - Maroc -->
                    <article class="trek-card" data-price="1200" data-duration="5" data-country="Maroc">
                        <div class="trek-image" style="background-image: url('https://desertmaroc.com/acaciavoyages/wp-content/uploads/2018/02/balade-dromadaire-desert-maroc.jpg');">
                            <img src="https://flagcdn.com/w80/ma.png" alt="Maroc" class="flag">
                            <div class="price-tag">À partir de <span class="price-value">1200</span>€</div>
                        </div>
                        <div class="trek-content">
                            <h3>Trek dans le Sahara Marocain</h3>
                            <div class="trek-meta">
                                <span><i class="icon">⏱️</i> <span class="duration-value">5</span> jours</span>
                                <span><i class="icon">🏜️</i> réserver pour un voyage exceptionnel</span>
                            </div>
                            <p>Explorez les dunes de Merzouga et dormez sous les étoiles dans un campement nomade traditionnel.</p>
                            <a href="trek-maroc.php" class="btn">Découvrir ce trek</a>
                        </div>
                    </article>

                    <!-- Trek 2 - Algérie -->
                    <article class="trek-card" data-price="1500" data-duration="7" data-country="Algérie">
                        <div class="trek-image" style="background-image: url('https://i.pinimg.com/736x/37/5b/2b/375b2b094c06ae6e19a59476dc1c5bfe.jpg');">
                            <img src="https://flagcdn.com/w80/dz.png" alt="Algérie" class="flag">
                            <div class="price-tag">À partir de <span class="price-value">1500</span>€</div>
                        </div>
                        <div class="trek-content">
                            <h3>Tassili n'Ajjer en Algérie</h3>
                            <div class="trek-meta">
                                <span><i class="icon">⏱️</i> <span class="duration-value">7</span> jours</span>
                                <span><i class="icon">🏜️</i> réserver pour un voyage exceptionnel</span>
                            </div>
                            <p>Découvrez les formations rocheuses spectaculaires et les anciennes peintures rupestres du Tassili.</p>
                            <a href="trek-algérie.php" class="btn">Découvrir ce trek</a>
                        </div>
                    </article>

                    <!-- Trek 3 - Tunisie -->
                    <article class="trek-card" data-price="950" data-duration="4" data-country="Tunisie">
                        <div class="trek-image" style="background-image: url('https://www.okvoyage.com/wp-content/uploads/2023/09/paysages-de-tunisie-scaled.jpg');">
                            <img src="https://flagcdn.com/w80/tn.png" alt="Tunisie" class="flag">
                            <div class="price-tag">À partir de <span class="price-value">950</span>€</div>
                        </div>
                        <div class="trek-content">
                            <h3>Désert de Douz en Tunisie</h3>
                            <div class="trek-meta">
                                <span><i class="icon">⏱️</i> <span class="duration-value">4</span> jours</span>
                                <span><i class="icon">🏜️</i> réserver pour un voyage exceptionnel</span>
                            </div>
                            <p>Parcourez les paysages variés du désert tunisien et visitez des oasis luxuriantes.</p>
                            <a href="trek-tunisie.php" class="btn">Découvrir ce trek</a>
                        </div>
                    </article>

                    <!-- Trek 4 - Égypte -->
                    <article class="trek-card" data-price="950" data-duration="4" data-country="Égypte">
                        <div class="trek-image" style="background-image: url('https://d3rr2gvhjw0wwy.cloudfront.net/uploads/activity_headers/174826/2000x2000-0-70-5650e47c4b8b8c0152f771bfffc89aea.jpg');">
                            <img src="https://flagpedia.net/data/flags/w1160/eg.webp" alt="Égypte" class="flag">
                            <div class="price-tag">À partir de <span class="price-value">950</span>€</div>
                        </div>
                        <div class="trek-content">
                            <h3>Désert Blanc en Égypte</h3>
                            <div class="trek-meta">
                                <span><i class="icon">⏱️</i> <span class="duration-value">4</span> jours</span>
                                <span><i class="icon">🏜️</i> réserver pour un voyage exceptionnel</span>
                            </div>
                            <p>Parcourez les paysages variés du désert égyptien et visitez des oasis luxuriantes.</p>
                            <a href="trek-égypte.php" class="btn">Découvrir ce trek</a>
                        </div>
                    </article>

                    <!-- Trek 5 - Mauritanie -->
                    <article class="trek-card" data-price="1150" data-duration="6" data-country="Mauritanie">
                        <div class="trek-image" style="background-image: url('https://desertmauritanie.com/wp-content/uploads/2019/05/Magnifique-photo-de-balade-dans-le-d%C3%A9sert-de-Mauritanie-e1587974011471.jpeg');">
                            <img src="https://flagpedia.net/data/flags/w1160/mr.webp" alt="Mauritanie" class="flag">
                            <div class="price-tag">À partir de <span class="price-value">1150</span>€</div>
                        </div>
                        <div class="trek-content">
                            <h3>Désert de l'Adrar en Mauritanie</h3>
                            <div class="trek-meta">
                                <span><i class="icon">⏱️</i> <span class="duration-value">6</span> jours</span>
                                <span><i class="icon">🏜️</i> réserver pour un voyage exceptionnel</span>
                            </div>
                            <p>Parcourez les paysages variés du désert mauritanien et visitez des oasis luxuriantes.</p>
                            <a href="trek-mauritanie.php" class="btn">Découvrir ce trek</a>
                        </div>
                    </article>

                    <article class="trek-card" data-price="1150" data-duration="4" data-country="Mali">
                        <div class="trek-image" style="background-image: url('https://th.bing.com/th/id/OIP.dKrDWlWj-66w_a1byUsmhAHaE8?rs=1&pid=ImgDetMain');">
                            <img src="https://th.bing.com/th/id/R.3c79387c53077c3d4ca8c3a5f274df0e?rik=dDrRpnN4IsW4GQ&riu=http%3a%2f%2fwww.drapeaux-du-monde.fr%2fdrapeaux-du-monde%2f3000%2fdrapeau-mali.jpg&ehk=PZTc9lzZsTDoLGwOo7H3oQyKfFYc%2bhgprXuRzUMymy4%3d&risl=&pid=ImgRaw&r=0" alt="Mali" class="flag">
                            <div class="price-tag">À partir de <span class="price-value">1150</span>€</div>
                        </div>
                        <div class="trek-content">
                            <h3>Désert Malien</h3>
                            <div class="trek-meta">
                                <span><i class="icon">⏱️</i> <span class="duration-value">4</span> jours</span>
                                <span><i class="icon">🏜️</i> réserver pour un voyage exceptionnel</span>
                            </div>
                            <p>Parcourez les paysages variés du désert malien et visitez des oasis luxuriantes.</p>
                            <a href="trek-mali.php" class="btn">Découvrir ce trek</a>
                        </div>
                    </article>

                    <article class="trek-card" data-price="1150" data-duration="4" data-country="soudan">
                        <div class="trek-image" style="background-image: url('https://th.bing.com/th/id/OIP.UDJb2M2tS5GM_4svuMt2SgHaEK?rs=1&pid=ImgDetMain');">
                            <img src="https://th.bing.com/th/id/R.eb8bc3a187650aa29594a1ac5ce72c1f?rik=CAQUl3TZHi5fEQ&riu=http%3a%2f%2fwww.drapeaux-du-monde.fr%2fdrapeaux-du-monde%2f3000%2fdrapeau-soudan.jpg&ehk=gtKwmdWHzHwgAfYmKexLAvhjGX7xPXpw6wjrQ%2bHJvWc%3d&risl=&pid=ImgRaw&r=0" alt="Mali" class="flag">
                            <div class="price-tag">À partir de <span class="price-value">2100</span>€</div>
                        </div>
                        <div class="trek-content">
                            <h3>Désert soudanais</h3>
                            <div class="trek-meta">
                                <span><i class="icon">⏱️</i> <span class="duration-value">4</span> jours</span>
                                <span><i class="icon">🏜️</i> réserver pour un voyage exceptionnel</span>
                            </div>
                            <p>Parcourez les paysages variés du désert soudanais et visitez des oasis luxuriantes.</p>
                            <a href="trek-soudan.php" class="btn">Découvrir ce trek</a>
                        </div>
                    </article>

                    <article class="trek-card" data-price="1150" data-duration="4" data-country="niger">
                        <div class="trek-image" style="background-image: url('https://th.bing.com/th/id/R.4ea2a00d3e8353f42d076baeb44b4302?rik=E%2fTu96Mf4QcWrQ&pid=ImgRaw&r=0');">
                            <img src="https://th.bing.com/th/id/OIP.O_Qij3gt8vBkrNhX6G-27wHaE8?rs=1&pid=ImgDetMain" alt="Niger" class="flag">
                            <div class="price-tag">À partir de <span class="price-value">1712</span>€</div>
                        </div>
                        <div class="trek-content">
                            <h3>Désert du Niger</h3>
                            <div class="trek-meta">
                                <span><i class="icon">⏱️</i> <span class="duration-value">4</span> jours</span>
                                <span><i class="icon">🏜️</i> réserver pour un voyage exceptionnel</span>
                            </div>
                            <p>Parcourez les paysages variés du désert du niger et visitez des oasis luxuriantes.</p>
                            <a href="trek-niger.php" class="btn">Découvrir ce trek</a>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <h4>Rajjel Agency</h4>
                    <p>Spécialistes des treks sahariens depuis 2010. Nous vous offrons des expériences authentiques et mémorables.</p>
                </div>
                <div class="footer-col">
                    <h4>Liens utiles</h4>
                    <ul>
                        <li><a href="acceuil1.php">Accueil</a></li>
                        <li><a href="aventure.php">Nos treks</a></li>
                        <li><a>Contact</a></li>
                        <li><a>Mentions légales</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contact</h4>
                    <p>contact@rajjel-agency.com<br>+33 1 23 45 67 89</p>
                    <div class="social-links">
                        <a href="#"><i>📱</i></a>
                        <a href="#"><i>📸</i></a>
                        <a href="#"><i>📘</i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Rajjel Agency. Tous droits réservés.</p>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                    <a href="admin.php" class="admin-link">Accès admin</a>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.getElementById('sort-by');
            const durationFilter = document.getElementById('filter-duration');
            const countryFilter = document.getElementById('filter-country');
            const searchBar = document.getElementById('search-bar');
            const trekCards = document.querySelectorAll('.trek-card');
            const trekGrid = document.querySelector('.treks-grid');

            // Fonction pour trier et filtrer les treks
            function updateTreks() {
                const sortValue = sortSelect.value;
                const durationValue = durationFilter.value;
                const countryValue = countryFilter.value;
                const searchValue = searchBar.value.toLowerCase();

                // Convertir NodeList en Array pour pouvoir utiliser sort()
                let cardsArray = Array.from(trekCards);

                // Filtrer par durée
                if (durationValue !== 'all') {
                    cardsArray = cardsArray.filter(card => {
                        const trekDuration = parseInt(card.dataset.duration);
                        return trekDuration >= parseInt(durationValue); // Filtrer par "et plus"
                    });
                }

                // Filtrer par pays
                if (countryValue !== 'all') {
                    cardsArray = cardsArray.filter(card => {
                        return card.dataset.country === countryValue;
                    });
                }

                // Filtrer par mots-clés (barre de recherche)
                if (searchValue) {
                    cardsArray = cardsArray.filter(card => {
                        const cardText = card.textContent.toLowerCase();
                        return cardText.includes(searchValue);
                    });
                }

                // Trier les résultats
                cardsArray.sort((a, b) => {
                    switch (sortValue) {
                        case 'price-asc':
                            return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                        case 'price-desc':
                            return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                        case 'duration-asc':
                            return parseInt(a.dataset.duration) - parseInt(b.dataset.duration);
                        case 'duration-desc':
                            return parseInt(b.dataset.duration) - parseInt(a.dataset.duration);
                        case 'country':
                            return a.dataset.country.localeCompare(b.dataset.country);
                        default:
                            return 0; // Pas de tri
                    }
                });

                // Réorganiser les cartes dans le DOM
                trekGrid.innerHTML = '';
                cardsArray.forEach(card => {
                    trekGrid.appendChild(card);
                });
            }

            // Écouter les changements des filtres
            sortSelect.addEventListener('change', updateTreks);
            durationFilter.addEventListener('change', updateTreks);
            countryFilter.addEventListener('change', updateTreks);
            searchBar.addEventListener('input', updateTreks); // Écouteur pour la barre de recherche
        });
    </script>
    <script src="js/theme.js"></script>
</body>

</html>
<?php
// Fin du fichier PHP
?>