<?php
session_start();


// Fonction pour mettre à jour le nom de l'utilisateur dans le CSV
function updateUserInCSV($oldEmail, $newName, $newEmail) {
    $csvFile = 'utilisateurs.csv';
    $tempFile = tempnam(sys_get_temp_dir(), 'tmp');
    $updated = false;

    if (($handle = fopen($csvFile, 'r')) !== false) {
        if (($tempHandle = fopen($tempFile, 'w')) !== false) {
            while (($data = fgetcsv($handle)) !== false) {
                // Si l'email matche, on met à jour les données
                if (isset($data[1]) && trim($data[1]) === $oldEmail) {
                    $data[0] = $newName;
                    $data[1] = $newEmail;
                    $updated = true;
                }
                fputcsv($tempHandle, $data);
            }
            fclose($tempHandle);
        }
        fclose($handle);

        if ($updated) {
            rename($tempFile, $csvFile);
            return true;
        } else {
            unlink($tempFile);
            return false;
        }
    }
    return false;
}


// Function to get the reservation image based on the destination
function getReservationImage($destination) {
    $images = [
        'Mauritanie' => 'images/mauritanie.jpg',
        'Algérie' => 'images/algerie.jpg',
        'Maroc' => 'images/maroc.jpg',
        'Tunisie' => 'images/tunisie.jpg',
        'Égypte' => 'images/egypte.jpg',
        'Sahara' => 'images/sahara.jpg',
        'Atlas' => 'images/atlas.jpg',
        'Merzouga' => 'images/merzouga.jpg'
    ];
    return $images[$destination] ?? 'images/default.jpg';
}

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php?redirect=profil.php');
    exit();
}

// Traitement du formulaire de mise à jour du profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_profile'])) {
    // Récupération des données du formulaire
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $oldEmail = $_SESSION['user']['email'];

    // Validation des données
    $errors = [];
    if (empty($nom)) {
        $errors[] = "Le nom est requis.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Une adresse email valide est requise.";
    }

    // Si aucune erreur, mise à jour des données
    if (empty($errors)) {
        if (updateUserInCSV($oldEmail, $nom, $email)) {
            // Met à jour la session
            $_SESSION['user']['nom'] = $nom;
            $_SESSION['user']['email'] = $email;
            
            
        }  else {
        echo "error:" . implode(", ", $errors);
        exit();}
    }
}

$user = $_SESSION['user'];
$reservations = [];
$reservationsEnCours = isset($_SESSION['reservation']) ? $_SESSION['reservation'] : null;

// Lecture des réservations confirmées depuis le fichier CSV
$csv_file = 'reservations.csv';
if (file_exists($csv_file)) {
    $file = fopen($csv_file, 'r');
    while (($data = fgetcsv($file)) !== false) {
        // Structure des données : [destination, type, date_depart, mode, nb_personnes, email, status]
        if (count($data) >= 6 && $data[5] === $user['email'] && (!isset($data[6]) || $data[6] === 'confirmed')) {
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

// Gestion de l'annulation d'une réservation en cours
if (isset($_GET['cancel']) && $_GET['cancel'] == 1 && isset($_SESSION['reservation'])) {
    unset($_SESSION['reservation']);
    $reservationsEnCours = null;
    header('Location: profil.php');
    exit();
}

// Affichage du message de succès après paiement
$paymentSuccess = isset($_GET['payment']) && $_GET['payment'] === 'success';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil | Rajjel Agency</title>
    <link rel="stylesheet" href="aventure.css">
    <link rel="stylesheet" href="profil.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
</head>
<body>
    <script src="theme.js"></script>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="acceuil1.php" class="logo">
                <img src="images/logo.png" alt="Rajjel Agency">
            </a>
            <ul class="nav-menu">
                <li><a href="acceuil1.php">Accueil</a></li>
                <li><a href="aventure.php">Nos Treks</a></li>
                <li><a href="presentation.php">Présentation</a></li>
                <!-- Thème & Police -->
                <li><button id="theme-toggle" class="btn-nav">🎨 Thème</button></li>
                <li>
                    <select id="font-size-selector" class="btn-nav">
                        <option value="normal">Aa</option>
                        <option value="medium">Aa+</option>
                        <option value="large">Aa++</option>
                    </select>
                </li>
                <li><a href="profil.php" class="btn-nav active">Mon Compte</a></li>
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
        <div class="container profile-container">
            <aside class="profile-sidebar">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['nom']) ?>&background=E67E22&color=fff&size=150"
                    alt="Avatar" class="profile-avatar">
                <h3><?= htmlspecialchars($user['nom']) ?></h3>
                <p><?= htmlspecialchars($user['email']) ?></p>

                <nav class="profile-nav">
                    <a href="profil.php" class="active">Mes Réservations</a>
                    <button id="toggle-edit-btn" class="btn-edit-profile">Modifier mon profil</button>
                    <a href="deco.php">Déconnexion</a>
                </nav>
            </aside>

            <section class="profile-edit-section" id="profile-edit-section" style="display: none;">
                <h2 class="section-title">Modifier mon Profil</h2>
                
                <?php if (!empty($errors)): ?>
                    <div class="alert-error">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="profil.php">
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="edit_profile" class="btn btn-save">Enregistrer</button>
                        <button type="button" id="cancel-edit-btn" class="btn btn-cancel">Annuler</button>
                    </div>
                </form>
            </section>

            <section class="profile-reservations">
                <?php if ($paymentSuccess): ?>
                    <div class="alert-success">
                        <i class="fas fa-check-circle"></i> Votre paiement a été confirmé avec succès !
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['success'])): ?>
                    <div class="alert-success">
                        <i class="fas fa-check-circle"></i> <?= htmlspecialchars($_GET['success']) ?>
                    </div>
                <?php endif; ?>

                <h2 class="section-title">Mes Réservations</h2>
                <p class="section-subtitle">Retrouvez ici toutes vos aventures confirmées</p>

                <?php if (!empty($reservations)): ?>
                    <div class="reservations-grid">
                        <?php foreach ($reservations as $reservation): ?>
                            <div class="reservation-card">
                                <img src="<?= getReservationImage($reservation['destination']) ?>" 
                                     alt="<?= htmlspecialchars($reservation['destination']) ?>" 
                                     class="reservation-image">
                                <div class="reservation-details">
                                    <h3>Trek <?= htmlspecialchars($reservation['destination']) ?></h3>
                                    <div class="trek-meta">
                                        <span><i class="far fa-calendar-alt"></i> <?= date('d/m/Y', strtotime($reservation['date_depart'])) ?></span>
                                        <span><i class="fas fa-users"></i> <?= $reservation['nb_personnes'] ?> personne(s)</span>
                                    </div>
                                    <p><strong>Type :</strong> <?= htmlspecialchars($reservation['type']) ?> | 
                                       <strong>Mode :</strong> <?= htmlspecialchars($reservation['mode']) ?></p>
                                    <a href="#" class="btn btn-edit">Voir les détails</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-reservations">
                        <p>Vous n'avez aucune réservation confirmée pour le moment.</p>
                        <a href="aventure.php" class="btn btn-edit">Découvrir nos treks</a>
                    </div>
                <?php endif; ?>
            </section>
        </div>

        <!-- Section Panier -->
        <section class="cart-section">
            <h2 class="cart-title">Mon Panier</h2>
            <div id="cart">
                <?php if ($reservationsEnCours): ?>
                    <div class="cart-item">
                        <div>
                            <h4><?= htmlspecialchars($reservationsEnCours['destination']) ?></h4>
                            <p><strong>Type :</strong> <?= htmlspecialchars($reservationsEnCours['type_trek']) ?></p>
                            <p><strong>Date de départ :</strong> <?= htmlspecialchars($reservationsEnCours['date_depart']) ?></p>
                            <p><strong>Nombre de personnes :</strong> <?= htmlspecialchars($reservationsEnCours['nb_personnes']) ?></p>
                        </div>
                        <div class="cart-actions">
                            <a href="recap-reservation.php" class="btn btn-confirm">Finaliser la réservation</a>
                            <a href="profil.php?cancel=1" class="btn btn-cancel">Annuler</a>
                        </div>
                    </div>
                <?php else: ?>
                    <p>Votre panier est vide.</p>
                    <a href="aventure.php" class="btn btn-edit">Découvrir nos treks</a>
                <?php endif; ?>
            </div>
        </section>
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
                    <p>contact@rajjel-agency.com<br>+33 1 23 45 67 89</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> Rajjel Agency. Tous droits réservés.</p>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                    <a href="admin.php" class="admin-link">Accès admin</a>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleEditBtn = document.getElementById('toggle-edit-btn');
            const cancelEditBtn = document.getElementById('cancel-edit-btn');
            const editSection = document.getElementById('profile-edit-section');
            
            toggleEditBtn.addEventListener('click', function() {
                editSection.style.display = editSection.style.display === 'none' ? 'block' : 'none';
            });
            
            cancelEditBtn.addEventListener('click', function() {
                editSection.style.display = 'none';
            });
            
            // Afficher la section d'édition s'il y a des erreurs
            <?php if (!empty($errors)): ?>
                editSection.style.display = 'block';
            <?php endif; ?>
        });
    </script>
</body>
</html>
