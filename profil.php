<?php
session_start();

// Function to get the reservation image based on the destination
function getReservationImage($destination)
{
    $images = [
        'Sahara' => 'images/sahara.jpg',
        'Atlas' => 'images/atlas.jpg',
        'Merzouga' => 'images/merzouga.jpg',
        // Add more destinations and their corresponding images here
    ];
    return $images[$destination] ?? 'images/default.jpg'; // Default image if destination not found
}

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php?redirect=profil.php');
    exit();
}

$user = $_SESSION['user'];
$reservations = [];

// Lecture des réservations depuis le fichier CSV
$csv_file = 'reservations.csv';
if (file_exists($csv_file)) {
    $file = fopen($csv_file, 'r');
    fgetcsv($file); // Ignore la première ligne (en-tête)
    while (($data = fgetcsv($file)) !== false) {
        // Structure des données : [destination, type, date_depart, mode, nb_personnes, email]
        if (isset($data[5]) && $data[5] === $user['email']) { // Filtre par email de l'utilisateur connecté
            $reservations[] = [
                'destination' => $data[0],
                'type' => $data[1],
                'date_depart' => $data[2],
                'mode' => $data[3],
                'nb_personnes' => $data[4]
            ];
        }
    }
    fclose($file);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil | Rajjel Agency</title>
    <link rel="stylesheet" href="aventure.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Ajouts stylistiques pour améliorer le design */
        .profile-hero {
            background: linear-gradient(135deg, #E67E22 0%, #D35400 100%);
            padding: 5rem 0;
            text-align: center;
            color: white;
            margin-bottom: 3rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .hero-content h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        .profile-layout {
            display: flex;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .profile-sidebar {
            flex: 0 0 280px;
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            height: fit-content;
            position: sticky;
            top: 2rem;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1.5rem;
            display: block;
            border: 4px solid #E67E22;
        }

        .profile-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .profile-nav a {
            padding: 0.8rem 1rem;
            border-radius: 6px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .profile-nav a:hover,
        .profile-nav a.active {
            background-color: #F5F5F5;
            color: #E67E22;
        }

        .profile-nav a.active {
            font-weight: 600;
            border-left: 3px solid #E67E22;
        }

        .profile-reservations {
            flex: 1;
        }

        .section-title {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 0.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: #E67E22;
        }

        .section-subtitle {
            color: #666;
            margin-bottom: 2rem;
            font-size: 1rem;
        }

        .reservations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
        }

        .reservation-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .reservation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .reservation-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .reservation-details {
            padding: 1.5rem;
        }

        .reservation-details h3 {
            margin: 0 0 1rem;
            color: #333;
            font-size: 1.3rem;
        }

        .trek-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
            align-items: center;
        }

        .trek-meta span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            color: #555;
            font-size: 0.9rem;
        }

        .reservation-status {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-confirmed {
            background-color: #E1F5E1;
            color: #2E7D32;
        }

        .no-reservations {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .no-reservations p {
            margin-bottom: 1.5rem;
            color: #666;
            font-size: 1.1rem;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: #E67E22;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #D35400;
            transform: translateY(-2px);
        }

        .btn-edit {
            background: white;
            color: #E67E22;
            border: 1px solid #E67E22;
            margin-top: 1rem;
        }

        .btn-edit:hover {
            background: #E67E22;
            color: white;
        }

        @media (max-width: 768px) {
            .profile-layout {
                flex-direction: column;
            }

            .profile-sidebar {
                position: static;
                margin-bottom: 2rem;
            }

            .reservations-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <script src="theme.js"></script>

    <nav class="navbar">
        <div class="container">
            <a href="acceuil1.php" class="logo">
                <img src="images/logo.png" alt="Rajjel Agency">
            </a>
            <ul class="nav-menu">
                <li><a href="acceuil1.php">Accueil</a></li>
                <li><a href="aventure.php">Nos Treks</a></li>
                <li><a href="presentation.php">Présentation</a></li>
                <li><button id="theme-toggle" class="btn-nav">🎨 Thème</button></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="profil.php" class="btn-nav active"><i class="fas fa-user"></i> Mon Compte</a></li>
            </ul>
        </div>
    </nav>

    <header class="profile-hero">
        <div class="container hero-content">
            <h1>Bienvenue, <?= htmlspecialchars($user['nom']) ?></h1>
            <p>Votre espace personnel pour gérer vos réservations et préférences</p>
        </div>
    </header>

    <main class="main-content">
        <div class="container profile-layout">
            <!-- Barre latérale -->
            <aside class="profile-sidebar">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['nom']) ?>&background=E67E22&color=fff&size=150"
                    alt="Avatar" class="profile-avatar">
                <h3><?= htmlspecialchars($user['nom']) ?></h3>
                <p><?= htmlspecialchars($user['email']) ?></p>

                <nav class="profile-nav">
                    <a href="profil.php" class="active"><i class="fas fa-calendar-alt"></i> Mes Réservations</a>
                    <a href="profil-edit.php"><i class="fas fa-user-edit"></i> Modifier mon profil</a>
                    <a href="profil-password.php"><i class="fas fa-lock"></i> Changer mon mot de passe</a>
                    <a href="deco.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                </nav>
            </aside>

            <!-- Contenu des réservations -->
            <section class="profile-reservations">
                <h2 class="section-title">Mes Réservations</h2>
                <p class="section-subtitle">Retrouvez ici toutes vos aventures à venir et passées</p>

                <?php if (!empty($user_reservations)): ?>
                    <div class="reservations-grid">
                        <?php foreach ($user_reservations as $reservation): ?>
                            <div class="reservation-card">
                                <img src="<?= getReservationImage($reservation['destination']) ?>" alt="<?= htmlspecialchars($reservation['destination']) ?>" class="reservation-image">
                                <div class="reservation-details">
                                    <h3>Trek <?= htmlspecialchars($reservation['destination']) ?></h3>
                                    <div class="trek-meta">
                                        <span><i class="far fa-calendar-alt"></i> <?= date('d/m/Y', strtotime($reservation['date_depart'])) ?></span>
                                        <span><i class="fas fa-users"></i> <?= $reservation['nb_personnes'] ?> personne(s)</span>
                                        <span class="reservation-status status-confirmed"><i class="fas fa-check-circle"></i> Confirmée</span>
                                    </div>
                                    <p><strong>Type :</strong> <?= htmlspecialchars($reservation['type']) ?> | <strong>Mode :</strong> <?= htmlspecialchars($reservation['mode']) ?></p>
                                    <a href="#" class="btn btn-edit"><i class="fas fa-info-circle"></i> Voir les détails</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-reservations">
                        <p>Vous n'avez aucune réservation pour le moment.</p>
                        <a href="aventure.php" class="btn"><i class="fas fa-route"></i> Découvrir nos treks</a>
                    </div>
                <?php endif; ?>
            </section>
        </div>
    </main>

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
                    <p><i class="fas fa-envelope"></i> contact@rajjel-agency.com<br><i class="fas fa-phone"></i> +33 1 23 45 67 89</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> Rajjel Agency. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>

</html>