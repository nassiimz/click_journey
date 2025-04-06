<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php?redirect=profil.php');
    exit();
}

// Récupérer les informations de l'utilisateur
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil | Rajjel Agency</title>
    <link rel="stylesheet" href="aventure.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        /* Styles supplémentaires spécifiques au profil */
        /* Correction pour le bouton Mon Compte */
.btn-nav {
    color: var(--white) !important;
    background-color: var(--primary-color);
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: var(--transition);
    display: inline-block;
}

.btn-nav:hover {
    background-color: var(--secondary-color);
    color: var(--white) !important;
}

.btn-nav.active {
    background-color: var(--secondary-color);
}
        .profile-hero {
            height: 40vh;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1518544866330-95a2bf92a4a8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;
            color: var(--white);
            display: flex;
            align-items: center;
            text-align: center;
            margin-top: 70px;
        }

        .profile-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 40px;
            margin: 50px auto;
        }

        .profile-sidebar {
            background-color: var(--white);
            border-radius: 10px;
            padding: 30px;
            box-shadow: var(--shadow);
            height: fit-content;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            display: block;
            border: 5px solid var(--light-color);
        }

        .profile-nav {
            margin-top: 30px;
        }

        .profile-nav a {
            display: block;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 5px;
            transition: var(--transition);
        }

        .profile-nav a:hover, .profile-nav a.active {
            background-color: rgba(230, 126, 34, 0.1);
            color: var(--primary-color);
        }

        .profile-content {
            background-color: var(--white);
            border-radius: 10px;
            padding: 40px;
            box-shadow: var(--shadow);
        }

        .reservation-card {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 20px;
            padding: 20px;
            border-bottom: 1px solid #eee;
            transition: var(--transition);
        }

        .reservation-card:hover {
            background-color: #f9f9f9;
        }

        .reservation-image {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .reservation-status {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-confirmed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .btn-edit {
            background-color: var(--dark-color);
            margin-top: 10px;
        }

        .btn-edit:hover {
            background-color: #1a252f;
        }

        @media (max-width: 768px) {
            .profile-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
                <li><a href="aventure.php">Nos Treks</a></li>
                <li><a href="presentation.php">Présentation</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="profil.php" class="btn-nav active">Mon Compte</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="profile-hero">
        <div class="container hero-content">
            <h1>Bienvenue, <?= htmlspecialchars($user['nom']) ?></h1>
            <p>Votre espace personnel pour gérer vos réservations et préférences</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container profile-container">
            <!-- Sidebar -->
            <aside class="profile-sidebar">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['nom']) ?>&background=E67E22&color=fff&size=150" 
                     alt="Avatar" class="profile-avatar">
                <h3><?= htmlspecialchars($user['nom']) ?></h3>
                <p><?= htmlspecialchars($user['email']) ?></p>
                
                <nav class="profile-nav">
                    <a href="profil.php" class="active">Mes Réservations</a>
                    <a href="profil-edit.php">Modifier mon profil</a>
                    <a href="profil-password.php">Changer mon mot de passe</a>
                    <a href="logout.php">Déconnexion</a>
                </nav>
            </aside>

            <!-- Main Profile Content -->
            <div class="profile-content">
                <h2 class="section-title">Mes Réservations</h2>
                <p class="section-subtitle">Retrouvez ici toutes vos aventures à venir et passées</p>

                <!-- Réservation 1 -->
                <div class="reservation-card">
                    <img src="https://images.unsplash.com/photo-1587854691369-3a7f4df9b725?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" 
                         alt="Tassili n'Ajjer" class="reservation-image">
                    <div>
                        <h3>Tassili n'Ajjer en Algérie</h3>
                        <div class="trek-meta">
                            <span><i class="icon">📅</i> 15-22 Nov 2023</span>
                            <span><i class="icon">👥</i> 2 personnes</span>
                            <span class="reservation-status status-confirmed">Confirmée</span>
                        </div>
                        <p>Découverte des formations rocheuses spectaculaires et des anciennes peintures rupestres.</p>
                        <a href="#" class="btn btn-edit">Voir les détails</a>
                    </div>
                </div>

                <!-- Réservation 2 -->
                <div class="reservation-card">
                    <img src="https://desertmaroc.com/acaciavoyages/wp-content/uploads/2018/02/balade-dromadaire-desert-maroc.jpg" 
                         alt="Sahara Marocain" class="reservation-image">
                    <div>
                        <h3>Trek dans le Sahara Marocain</h3>
                        <div class="trek-meta">
                            <span><i class="icon">📅</i> 10-15 Jan 2024</span>
                            <span><i class="icon">👥</i> 4 personnes</span>
                            <span class="reservation-status status-pending">En attente</span>
                        </div>
                        <p>Explorez les dunes de Merzouga et dormez sous les étoiles dans un campement nomade.</p>
                        <a href="#" class="btn btn-edit">Modifier la réservation</a>
                    </div>
                </div>

                <!-- Message si pas de réservations -->
                <!-- <div class="no-reservations">
                    <p>Vous n'avez aucune réservation pour le moment.</p>
                    <a href="aventure.php" class="btn">Découvrir nos treks</a>
                </div> -->
            </div>
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