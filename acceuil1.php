<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil | Rajjel Agency</title>
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
                <li><a href="acceuil1.php" class="active">Accueil</a></li>
                <li><a href="aventure.php">Nos Treks</a></li>
                <li><a href="presentation.php">Présentation</a></li>
                
                <?php if(isset($_SESSION['user'])): ?>
                    <li><a href="profil.php" class="btn-nav">Mon Compte</a></li>
                <?php else: ?>
                    <li><a href="connexion.php" class="btn-nav">Mon compte</a></li>
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
                    <img src="https://images.unsplash.com/photo-1517825738774-7de9363ef735?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Groupe en trek dans le désert">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Styles pour la section Bienvenue */
    .welcome-section {
        padding: 60px 0;
        background: linear-gradient(to bottom, #f9f9f9, #ffffff);
    }
    
    .welcome-content h2 {
        text-align: center;
        font-size: 2.2rem;
        color: #2C3E50;
        margin-bottom: 40px;
        position: relative;
    }
    
    .welcome-content h2:after {
        content: '';
        display: block;
        width: 80px;
        height: 3px;
        background: #E67E22;
        margin: 15px auto 0;
    }
    
    .welcome-grid {
        display: flex;
        align-items: center;
        gap: 40px;
    }
    
    .welcome-text {
        flex: 1;
    }
    
    .welcome-text p {
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 30px;
        color: #555;
    }
    
    .welcome-image {
        flex: 1;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .welcome-image img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.5s ease;
    }
    
    .welcome-image:hover img {
        transform: scale(1.03);
    }
    
    .welcome-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }
    
    .feature-item {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        text-align: center;
        transition: transform 0.3s ease;
    }
    
    .feature-item:hover {
        transform: translateY(-5px);
    }
    
    .feature-icon {
        font-size: 2rem;
        display: block;
        margin-bottom: 10px;
    }
    
    .feature-item h3 {
        color: #E67E22;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }
    
    .feature-item p {
        font-size: 0.9rem;
        color: #666;
    }
    
    @media (max-width: 768px) {
        .welcome-grid {
            flex-direction: column;
        }
        
        .welcome-content h2 {
            font-size: 1.8rem;
        }
        
        .welcome-features {
            grid-template-columns: 1fr;
        }
    }
</style>

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
                            <a href="trek-algerie.php" class="btn">En savoir plus</a>
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
               a         <a href="#"><i>📘</i></a>
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