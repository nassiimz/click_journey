<?php
session_start();

$errors = []; // <-- Ajoute cette ligne ici

// Fonction pour mettre à jour le nom de l'utilisateur dans le CSV
function updateUserInCSV($oldEmail, $newName, $newEmail)
{
    $csvFile = 'utilisateurs.csv';
    $tempFile = tempnam(sys_get_temp_dir(), 'tmp');
    $updated = false;

    if (($handle = fopen($csvFile, 'r')) !== false) {
        if (($tempHandle = fopen($tempFile, 'w')) !== false) {
            while (($data = fgetcsv($handle)) !== false) {
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
function getReservationImage($destination)
{
    $images = [
        'Mauritanie' => 'https://th.bing.com/th/id/OIP.E0hc14Y_fsE74rT9w4EapgHaEK?rs=1&pid=ImgDetMain',
        'Algérie' => 'https://th.bing.com/th/id/R.7b7aa9918bd1d7da7d9a1a6632f12adb?rik=NLNuxpGwIPB3RQ&riu=http%3a%2f%2fwww.drapeaux-du-monde.fr%2fdrapeaux-du-monde%2f3000%2fdrapeau-algerie.jpg&ehk=I0p0pxsKNgIH1fAeoIhvMgDyOXAjdsuVWNcBBv4cwFk%3d&risl=&pid=ImgRaw&r=0',
        'Maroc' => 'https://th.bing.com/th/id/R.4982250f8165fda447678dfadb1ab146?rik=UBnaKKC%2f6NYmHw&riu=http%3a%2f%2fwww.guidedumaroc.com%2fmaroc%2fmaroc.jpg&ehk=vZAKbv%2fgQ4LAS%2bsVWwnUXuwm0gJc4l%2bKdrCU0tCbLW8%3d&risl=&pid=ImgRaw&r=0',
        'Tunisie' => 'https://th.bing.com/th/id/OIP.fDsvL0UfMokOy0E8593FKQHaEe?rs=1&pid=ImgDetMain',
        'Égypte' => 'https://th.bing.com/th/id/R.141e624a0497bc47e8fddb04fe47e4d1?rik=8wgsMKEGgUAb0w&riu=http%3a%2f%2fwww.drapeaux-du-monde.fr%2fdrapeaux-du-monde%2f3000%2fdrapeau-egypte.jpg&ehk=lvuvFXM86UYp1sFIwQqxdghM88oNE%2bsVd4sRTLuWvM8%3d&risl=&pid=ImgRaw&r=0',
        'Mali' => 'https://th.bing.com/th/id/R.3c79387c53077c3d4ca8c3a5f274df0e?rik=dDrRpnN4IsW4GQ&riu=http%3a%2f%2fwww.drapeaux-du-monde.fr%2fdrapeaux-du-monde%2f3000%2fdrapeau-mali.jpg&ehk=PZTc9lzZsTDoLGwOo7H3oQyKfFYc%2bhgprXuRzUMymy4%3d&risl=&pid=ImgRaw&r=0',
        'Soudan' => 'https://th.bing.com/th/id/R.eb8bc3a187650aa29594a1ac5ce72c1f?rik=CAQUl3TZHi5fEQ&riu=http%3a%2f%2fwww.drapeaux-du-monde.fr%2fdrapeaux-du-monde%2f3000%2fdrapeau-soudan.jpg&ehk=gtKwmdWHzHwgAfYmKexLAvhjGX7xPXpw6wjrQ%2bHJvWc%3d&risl=&pid=ImgRaw&r=0',
        'Niger' => 'https://wallpapercave.com/wp/wp4213312.png'
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
            $_SESSION['user']['nom'] = $nom;
            $_SESSION['user']['email'] = $email;
            header('Location: profil.php?success=Profil mis à jour avec succès');
            exit();
        } else {
            $errors[] = "Erreur lors de la mise à jour du profil.";
        }
    }
}

$user = $_SESSION['user'];
$reservationsEnCours = isset($_SESSION['reservation']) ? $_SESSION['reservation'] : null;

// Lecture des réservations confirmées depuis le fichier CSV
$reservations = [];
if (file_exists('reservations.csv')) {
    if (($handle = fopen('reservations.csv', 'r')) !== false) {
        $header = fgetcsv($handle); // Ignore la première ligne
        while (($data = fgetcsv($handle)) !== false) {
            if (
                isset($data[5]) && $data[5] === $user['email'] &&
                isset($data[6]) && $data[6] === 'confirmed'
            ) {
                $reservations[] = [
                    'destination' => $data[0],
                    'type' => $data[1],
                    'date_depart' => $data[2],
                    'mode' => $data[3],
                    'nb_personnes' => $data[4],
                    'date_reservation' => isset($data[7]) ? $data[7] : 'Date inconnue'
                ];
            }
        }
        fclose($handle);
    }
}

// Gestion de l'annulation d'une réservation en cours
if (isset($_GET['cancel']) && $_GET['cancel'] == 1 && isset($_SESSION['reservation'])) {
    unset($_SESSION['reservation']);
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
                <img src="logofinal2.png" alt="Rajjel Agency">
            </a>
            <ul class="nav-menu">
                <li><a href="acceuil1.php">Accueil</a></li>
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

                <?php
                $adminEmails = [
                    "nassimizza@gmail.com",
                    "nassimbouslimani@gmail.com",
                    "nassimsefraoui@gmail.com"
                ];
                if ((isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin') ||
                    (isset($_SESSION['user']['email']) && in_array($_SESSION['user']['email'], $adminEmails))
                ) { ?>
                    <a href="admin.php" class="admin-link">Admin</a>
                <?php } ?>
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
                                        <strong>Mode :</strong> <?= htmlspecialchars($reservation['mode']) ?>
                                    </p>
                                    <p><strong>Date de réservation :</strong> <?= $reservation['date_reservation'] ?></p>
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
                            <h4>Trek <?= htmlspecialchars($reservationsEnCours['destination']) ?></h4>
                            <p><strong>Type :</strong> <?= htmlspecialchars($reservationsEnCours['type_trek']) ?></p>
                            <p><strong>Date de départ :</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($reservationsEnCours['date_depart']))) ?></p>
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
                        <li><a>Contact</a></li>
                        <li><a>Mentions légales</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contact</h4>
                    <p>contact@rajjel-agency.com<br>+33 1 23 45 67 89</p>
                    <div class="social-links">
                        <a><i class="fab fa-facebook-f"></i></a>
                        <a><i class="fab fa-instagram"></i></a>
                        <a><i class="fab fa-twitter"></i></a>
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

            <?php if (!empty($errors)): ?>
                editSection.style.display = 'block';
            <?php endif; ?>
        });
    </script>
</body>

</html>