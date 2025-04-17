<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Aventures Sahariennes | Rajjel Agency</title>
    <link rel="stylesheet" href="aventure.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="acceuil1.php" class="logo">
                <img src="images/logo.png" alt="Rajjel Agency">
                <span>Rajjel Agency</span>
            </a>
            <ul class="nav-menu">
                <li><a href="acceuil1.php">Accueil</a></li>
                <li><a href="aventure.php" class="active">Nos Treks</a></li>
                <li><a href="presentation.php">Présentation</a></li>
             
                <?php if(isset($_SESSION['user'])): ?>
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
                
                <div class="treks-grid">
                    <!-- Trek 1 -->
                    <article class="trek-card">
                        <div class="trek-image" style="background-image: url('https://desertmaroc.com/acaciavoyages/wp-content/uploads/2018/02/balade-dromadaire-desert-maroc.jpg');">
                            <img src="https://flagcdn.com/w80/ma.png" alt="Maroc" class="flag">
                            <div class="price-tag">À partir de 1200€</div>
                        </div>
                        <div class="trek-content">
                            <h3>Trek dans le Sahara Marocain</h3>
                            <div class="trek-meta">
                                <span><i class="icon">⏱️</i> 5 jours</span>
                                <span><i class="icon">🏜️</i>  réserver pour un voyage exceptionelle</span>
                            </div>
                            <p>Explorez les dunes de Merzouga et dormez sous les étoiles dans un campement nomade traditionnel.</p>
                            <a href="trek-maroc.php" class="btn">Découvrir ce trek</a>
                        </div>
                    </article>

                    <!-- Trek 2 -->
                    <article class="trek-card">
                        <div class="trek-image" style="background-image: url('https://i.pinimg.com/736x/37/5b/2b/375b2b094c06ae6e19a59476dc1c5bfe.jpg');">
                            <img src="https://flagcdn.com/w80/dz.png" alt="Algérie" class="flag">
                            <div class="price-tag">À partir de 1500€</div>
                        </div>
                        <div class="trek-content">
                            <h3>Tassili n'Ajjer en Algérie</h3>
                            <div class="trek-meta">
                                <span><i class="icon">⏱️</i> 4 jours</span>
                                <span><i class="icon">🏜️</i>  réserver pour un voyage exceptionelle</span>
                            </div>
                            <p>Découvrez les formations rocheuses spectaculaires et les anciennes peintures rupestres du Tassili.</p>
                            <a href="trek-algérie.php" class="btn">Découvrir ce trek</a>
                        </div>
                    </article>

                    <!-- Trek 3 -->
                    <article class="trek-card">
                        <div class="trek-image" style="background-image: url('https://www.okvoyage.com/wp-content/uploads/2023/09/paysages-de-tunisie-scaled.jpg');">
                            <img src="https://flagcdn.com/w80/tn.png" alt="Tunisie" class="flag">
                            <div class="price-tag">À partir de 950€</div>
                        </div>
                        <div class="trek-content">
                            <h3>Désert de Douz en Tunisie</h3>
                            <div class="trek-meta">
                                <span><i class="icon">⏱️</i> 4 jours</span>
                                <span><i class="icon">🏜️</i> réserver pour un voyage exceptionelle</span>
                            </div>
                            <p>Parcourez les paysages variés du désert tunisien et visitez des oasis luxuriantes.</p>
                            <a href="trek-tunisie.php" class="btn">Découvrir ce trek</a>
                        </div>
                    </article>

                     <!-- Trek 4 -->
                     <article class="trek-card">
                        <div class="trek-image" style="background-image: url('https://d3rr2gvhjw0wwy.cloudfront.net/uploads/activity_headers/174826/2000x2000-0-70-5650e47c4b8b8c0152f771bfffc89aea.jpg');">
                            <img src=" https://flagpedia.net/data/flags/w1160/eg.webp" alt="Tunisie" class="flag">
                            <div class="price-tag">À partir de 950€</div>
                        </div>
                        <div class="trek-content">
                            <h3>Désert de Douz en Egypte</h3>
                            <div class="trek-meta">
                                <span><i class="icon">⏱️</i> 4 jours</span>
                                <span><i class="icon">🏜️</i>  réserver pour un voyage exceptionelle</span>
                            </div>
                            <p>Parcourez les paysages variés du désert égyptien et visitez des oasis luxuriantes.</p>
                            <a href="trek-égypte.php" class="btn">Découvrir ce trek</a>
                        </div>
                    </article>


                     <!-- Trek 5 -->
                     <article class="trek-card">
                        <div class="trek-image" style="background-image: url('https://desertmauritanie.com/wp-content/uploads/2019/05/Magnifique-photo-de-balade-dans-le-d%C3%A9sert-de-Mauritanie-e1587974011471.jpeg');">
                            <img src="https://flagpedia.net/data/flags/w1160/mr.webp" alt="Tunisie" class="flag">
                            <div class="price-tag">À partir de 950€</div>
                        </div>
                        <div class="trek-content">
                            <h3>Désert de Douz en Mauritanie</h3>
                            <div class="trek-meta">
                                <span><i class="icon">⏱️</i> 4 jours</span>
                                <span><i class="icon">🏜️</i> réserver pour un voyage exceptionelle</span>
                            </div>
                            <p>Parcourez les paysages variés du désert mauritanien et visitez des oasis luxuriantes.</p>
                            <a href="trek-mauritanie.php" class="btn">Découvrir ce trek</a>
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
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="mentions-legales.php">Mentions légales</a></li>
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
                <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                    <a href="admin.php" class="admin-link">Accès admin</a>
                <?php endif; ?>
            </div>
        </div>
    </footer>
</body>
</html>
