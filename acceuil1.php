<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil | Rajjel Agency</title>
    <link rel="stylesheet" href="acceuil.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>

<body>
    <script src="theme.js"></script>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="acceuil1.php" class="logo">
                <img src="logofinal2.png" alt="Rajjel Agency">
            </a>
            <ul class="nav-menu">
                <li><a href="acceuil1.php" class="active">Accueil</a></li>
                <li><a href="aventure.php">Nos Treks</a></li>
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
    <header class="hero" style="background-image: url('https://www.voyage-maroc.com/cdn/ma-public/oasis_ziz.jpg');">
        <div class="hero-content">
            <h1>Rajjel Agency</h1>
            <p>Votre guide pour des aventures inoubliables dans les déserts du monde</p>
            <a href="aventure.php" class="btn">Découvrez nos treks</a>
        </div>
    </header>

    <section class="welcome-section">
        <div class="container">
            <div class="welcome-content">
                <h2>Bienvenue dans l'Aventure Saharienne</h2>
                <div class="welcome-grid">
                    <div class="welcome-text">
                        <p>Depuis 2010, Rajjel Agency vous invite à découvrir les secrets les mieux gardés du désert. Nos expéditions soigneusement conçues allient <strong>aventure authentique</strong>, <strong>respect des cultures locales</strong> et <strong>sécurité maximale</strong>.</p>

                        <div class="welcome-features">
                            <div class="feature-item">
                                <span class="feature-icon">🌵</span>
                                <h3>Expérience Unique</h3>
                                <p>Itinéraires exclusifs hors des sentiers battus</p>
                            </div>
                            <div class="feature-item">
                                <span class="feature-icon">👨‍🌾</span>
                                <h3>Guides Experts</h3>
                                <p>Accompagnement par des nomades sahariens</p>
                            </div>
                            <div class="feature-item">
                                <span class="feature-icon">✨</span>
                                <h3>Confort Désert</h3>
                                <p>Bivouacs équipés et repas traditionnels</p>
                            </div>
                        </div>
                    </div>
                    <div class="welcome-image">
                        <img src="https://cdn0.projetecolo.com/fr/posts/1/2/1/animaux_du_desert_du_sahara_noms_caracteristiques_et_photos_121_orig.jpg" alt="Groupe en trek dans le désert">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <section class="featured-treks">
                <h2 class="section-title">Nos Treks Phares</h2>
                <p class="section-subtitle">Quelques-unes de nos aventures les plus populaires</p>

                <div class="treks-grid">
                    <!-- Trek 1 -->
                    <article class="trek-card">
                        <div class="trek-image" style="background-image: url('https://desertmaroc.com/acaciavoyages/wp-content/uploads/2018/02/balade-dromadaire-desert-maroc.jpg');">
                            <img src="https://flagcdn.com/w80/ma.png" alt="Maroc" class="flag">
                        </div>
                        <div class="trek-content">
                            <h3>Sahara Marocain</h3>
                            <p>Découvrez les dunes de Merzouga et dormez sous les étoiles dans un campement nomade.</p>
                            <a href="trek-maroc.php" class="btn">En savoir plus</a>
                        </div>
                    </article>

                    <!-- Trek 2 -->
                    <article class="trek-card">
                        <div class="trek-image" style="background-image: url('https://i.pinimg.com/736x/37/5b/2b/375b2b094c06ae6e19a59476dc1c5bfe.jpg');">
                            <img src="https://flagcdn.com/w80/dz.png" alt="Algérie" class="flag">
                        </div>
                        <div class="trek-content">
                            <h3>Tassili n'Ajjer</h3>
                            <p>Explorez les formations rocheuses spectaculaires et les anciennes peintures rupestres.</p>
                            <a href="trek-algérie.php" class="btn">En savoir plus</a>
                        </div>
                    </article>
                </div>

                <div class="center-btn">
                    <a href="aventure.php" class="btn">Voir tous nos treks</a>
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

    <!-- ✅ Inclusion unique du JS thème + accessibilité -->
    <script src="js/theme.js"></script>
</body>

</html>