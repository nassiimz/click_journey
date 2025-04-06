<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php?redirect=recap-reservation.php');
    exit();
}

// Vérifier s'il y a une réservation en session
if (!isset($_SESSION['reservation'])) {
    header('Location: aventure.php');
    exit();
}

$reservation = $_SESSION['reservation'];

// Calcul du prix en fonction du type de trek
$prix_trek = 0;
switch ($reservation['type_trek']) {
    case 'standard':
        $prix_trek = 300;
        $type_trek_libelle = "Trek standard (4 jours)";
        break;
    case 'premium':
        $prix_trek = 645;
        $type_trek_libelle = "Trek premium avec guide privé";
        break;
    case 'luxe':
        $prix_trek = 750;
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
                <a href="paiement.php" class="btn">Procéder au paiement</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?= date('Y') ?> Rajjel Agency. Tous droits réservés.</p>
            <div class="footer-links">
                <a href="mentions-legales.php">Mentions légales</a>
                <a href="contact.php">Contact</a>
                <a href="cgv.php">CGV</a>
            </div>
        </div>
    </footer>
</body>
</html>
