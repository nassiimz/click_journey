<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php?redirect=recap-reservation.php');
    exit();
}

if (!isset($_SESSION['reservation'])) {
    header('Location: aventure.php');
    exit();
}

// Traitement après paiement réussi
if (isset($_GET['payment']) && $_GET['payment'] === 'success') {
    $reservation = $_SESSION['reservation'];
    if (!isset($_SESSION['user']['email'])) {
        header('Location: profil.php?error=email');
        exit();
    }

    $ligne = [
        $reservation['destination'],
        $reservation['type_trek'],
        $reservation['date_depart'],
        $reservation['billet_avion'],
        $reservation['nb_personnes'],
        $_SESSION['user']['email'],
        'confirmed',
        date('Y-m-d H:i:s') // Ajoute la date ici
    ];

    // Créer le fichier s'il n'existe pas
    if (!file_exists('reservations.csv')) {
        file_put_contents('reservations.csv', "Destination,Type,Date Départ,Billet Avion,Nb Personnes,Email,Statut,Date Réservation\n");
    }

    $file = fopen('reservations.csv', 'a');
    fputcsv($file, $ligne);
    fclose($file);

    unset($_SESSION['reservation']);
    header('Location: profil.php?payment=success');
    exit();
}

$reservation = $_SESSION['reservation'];

// Définir les prix et la durée des treks en fonction de la destination
$prix_trek_base = 0;
$duree_sejour = 0;
switch ($reservation['destination']) {
    case 'Mauritanie':
        $prix_trek_base = 1150; // Prix pour le trek standard
        $duree_sejour = 6; // Durée en jours
        break;
    case 'Algérie':
        $prix_trek_base = 700; // Prix pour le trek standard
        $duree_sejour = 7; // Durée en jours
        break;
    case 'Maroc':
        $prix_trek_base = 990; // Exemple : Prix pour le trek standard
        $duree_sejour = 5; // Exemple : Durée en jours
        break;
    case 'Tunisie':
        $prix_trek_base = 300; // Exemple : Prix pour le trek standard
        $duree_sejour = 4; // Exemple : Durée en jours
        break;
    case 'Égypte':
        $prix_trek_base = 950; // Exemple : Prix pour le trek standard
        $duree_sejour = 4; // Exemple : Durée en jours
        break;
    case 'Mali':
        $prix_trek_base = 980; // Exemple : Prix pour le trek standard
        $duree_sejour = 4; // Exemple : Durée en jours
        break;
    case 'Soudan':
        $prix_trek_base = 1050; // Exemple : Prix pour le trek standard
        $duree_sejour = 4; // Exemple : Durée en jours
        break;
    case 'Niger':
        $prix_trek_base = 1050; // Exemple : Prix pour le trek standard
        $duree_sejour = 4; // Exemple : Durée en jours
        break;
    default:
        $prix_trek_base = 0;
        $duree_sejour = 0;
        break;
}

// Ajuster le prix en fonction du type de trek
$prix_trek = $prix_trek_base;
$type_trek_libelle = '';
switch ($reservation['type_trek']) {
    case 'standard':
        $type_trek_libelle = "Trek standard";
        break;
    case 'premium':
        $prix_trek += 400; // Supplément pour le trek premium
        $type_trek_libelle = "Trek premium avec guide privé";
        break;
    case 'luxe':
        $prix_trek += 700; // Supplément pour le trek luxe
        $type_trek_libelle = "Trek luxe avec campement tout confort";
        break;
}

// Calcul du prix du billet d'avion
$prix_avion = ($reservation['billet_avion'] === 'avec_agence') ? 800 : 0;
$billet_avion_libelle = ($reservation['billet_avion'] === 'avec_agence')
    ? "Billet d'avion inclus"
    : "Billet d'avion non inclus";

// Calcul du total
$total = ($prix_trek + $prix_avion) * $reservation['nb_personnes'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif de réservation | Rajjel Agency</title>
    <style>
        :root {
            --primary: #E67E22;
            --secondary: #D35400;
            --dark: #2C3E50;
            --light: #F5D29C;
            --white: #FFFFFF;
            --gray: #F5F5F5;
            --text: #333333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--gray);
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        header {
            background-color: var(--dark);
            color: var(--white);
            padding: 20px 0;
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .recap-container {
            background-color: var(--white);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        h2 {
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
        }

        .recap-details {
            margin-bottom: 30px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .detail-label {
            font-weight: 600;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            font-size: 1.2rem;
            font-weight: 600;
            border-top: 2px solid var(--primary);
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            background-color: var(--primary);
            color: var(--white);
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: var(--secondary);
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .btn-secondary {
            background-color: var(--dark);
        }

        footer {
            background-color: var(--dark);
            color: var(--white);
            padding: 30px 0;
            text-align: center;
            margin-top: 40px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .footer-links a {
            color: var(--light);
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <h1>Récapitulatif de votre réservation</h1>
            <p>Vérifiez les détails de votre trek avant paiement</p>
        </div>
    </header>

    <div class="container">
        <div class="recap-container">
            <h2>Détails de votre réservation</h2>

            <div class="recap-details">
                <div class="detail-row">
                    <span class="detail-label">Destination :</span>
                    <span>Trek <?= htmlspecialchars($reservation['destination']) ?> - <?= htmlspecialchars($type_trek_libelle) ?></span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Durée du séjour :</span>
                    <span><?= $duree_sejour ?> jours</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Date de départ :</span>
                    <span><?= htmlspecialchars(date('d/m/Y', strtotime($reservation['date_depart']))) ?></span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Option transport :</span>
                    <span><?= htmlspecialchars($billet_avion_libelle) ?></span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">Nombre de personnes :</span>
                    <span><?= htmlspecialchars($reservation['nb_personnes']) ?></span>
                </div>
            </div>

            <h2>Détail du prix</h2>

            <div class="recap-details">
                <div class="detail-row">
                    <span class="detail-label">Prix du trek (par personne) :</span>
                    <span><?= $prix_trek ?> €</span>
                </div>

                <?php if ($prix_avion > 0): ?>
                    <div class="detail-row">
                        <span class="detail-label">Prix du billet d'avion (par personne) :</span>
                        <span><?= $prix_avion ?> €</span>
                    </div>
                <?php endif; ?>

                <div class="detail-row">
                    <span class="detail-label">Nombre de personnes :</span>
                    <span><?= $reservation['nb_personnes'] ?></span>
                </div>

                <div class="total-row">
                    <span>Total à payer :</span>
                    <span><?= $total ?> €</span>
                </div>
            </div>

            <div class="btn-group">
                <a href="trek-<?= strtolower($reservation['destination']) ?>.php" class="btn btn-secondary">Modifier la réservation</a>
                <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST" style="display: inline;">
                    <?php
                    require('getapikey.php');
                    $transaction_id = substr(bin2hex(random_bytes(12)), 0, 15);
                    $vendeur = "MI-5_G";
                    $api_key = getAPIKey($vendeur);

                    $retour_url = 'http://' . $_SERVER['HTTP_HOST'] . '/click_journey-projetNassimFinal/recap-reservation.php?payment=success';
                    $control = md5($api_key . "#" . $transaction_id . "#" . $total . "#" . $vendeur . "#" . $retour_url . "#");
                    ?>
                    <input type="hidden" name="transaction" value="<?= $transaction_id ?>">
                    <input type="hidden" name="montant" value="<?= $total ?>">
                    <input type="hidden" name="vendeur" value="<?= $vendeur ?>">
                    <input type="hidden" name="retour" value="<?= $retour_url ?>">
                    <input type="hidden" name="control" value="<?= $control ?>">
                    <button type="submit" class="btn">Procéder au paiement</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?= date('Y') ?> Rajjel Agency. Tous droits réservés.</p>
        </div>
    </footer>
</body>

</html>