<?php
session_start();

// Vérifier si l'utilisateur est connecté et a une réservation
if (!isset($_SESSION['user']) || !isset($_SESSION['reservation'])) {
    header('Location: connexion.php');
    exit();
}

$reservation = $_SESSION['reservation'];

// Calcul des prix comme dans recap-reservation.php
$prix_trek = 0;
switch ($reservation['type_trek']) {
    case 'standard': $prix_trek = 300; break;
    case 'premium': $prix_trek = 645; break;
    case 'luxe': $prix_trek = 750; break;
}
$prix_avion = ($reservation['billet_avion'] === 'avec_agence') ? 800 : 0;
$total = ($prix_trek + $prix_avion) * $reservation['nb_personnes'];

// Génération d'un identifiant de transaction unique
$transaction_id = substr(bin2hex(random_bytes(12)), 0, 15);

// Configuration CYBank
$vendeur = "TEST"; // Code vendeur pour Rajjel Agency
require('getapikey.php');
$api_key = getAPIKey($vendeur);

// URL de retour après paiement
$retour_url = 'https://' . $_SERVER['HTTP_HOST'] . '/confirmation-paiement.php';

// Calcul du contrôle de sécurité
$control = md5($api_key . "#" . $transaction_id . "#" . $total . "#" . $vendeur . "#" . $retour_url . "#");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Sécurisé | Rajjel Agency</title>
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
            margin-bottom: 30px;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .payment-container {
            display: flex;
            gap: 30px;
        }

        .recap-panel {
            flex: 1;
            background-color: var(--white);
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .payment-panel {
            flex: 1;
            background-color: var(--white);
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
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

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .card-icons {
            text-align: center;
            margin: 20px 0;
        }

        .card-icons img {
            height: 30px;
            margin: 0 5px;
        }

        .btn {
            display: block;
            width: 100%;
            background-color: var(--primary);
            color: var(--white);
            padding: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: var(--secondary);
        }

        .test-card {
            background-color: #fffde7;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            font-size: 14px;
        }

        footer {
            background-color: var(--dark);
            color: var(--white);
            padding: 30px 0;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Paiement Sécurisé</h1>
            <p>Finalisez votre réservation en toute sécurité</p>
        </div>
    </header>

    <div class="container">
        <div class="payment-container">
            <!-- Panel récapitulatif -->
            <div class="recap-panel">
                <h2>Votre réservation</h2>
                
                <div class="detail-row">
                    <span class="detail-label">Destination :</span>
                    <span>Trek <?= htmlspecialchars($reservation['destination']) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Type de trek :</span>
                    <span>
                        <?php 
                        switch($reservation['type_trek']) {
                            case 'standard': echo "Standard (4 jours)"; break;
                            case 'premium': echo "Premium avec guide"; break;
                            case 'luxe': echo "Luxe tout confort"; break;
                        }
                        ?>
                    </span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Date :</span>
                    <span><?= htmlspecialchars(date('d/m/Y', strtotime($reservation['date_depart']))) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Personnes :</span>
                    <span><?= htmlspecialchars($reservation['nb_personnes']) ?></span>
                </div>
                
                <div class="total-row">
                    <span>Total :</span>
                    <span><?= $total ?> €</span>
                </div>
            </div>

            <!-- Panel de paiement -->
            <div class="payment-panel">
                <h2>Informations de paiement</h2>
                
                <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
                    <!-- Champs cachés pour CYBank -->
                    <input type="hidden" name="transaction" value="<?= $transaction_id ?>">
                    <input type="hidden" name="montant" value="<?= $total ?>">
                    <input type="hidden" name="vendeur" value="<?= $vendeur ?>">
                    <input type="hidden" name="retour" value="<?= $retour_url ?>">
                    <input type="hidden" name="control" value="<?= $control ?>">
                    
                    <div class="form-group">
                        <label for="cardholder">Nom du titulaire</label>
                        <input type="text" id="cardholder" name="cardholder" placeholder="Nom comme sur la carte" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cardnumber">Numéro de carte</label>
                        <input type="text" id="cardnumber" name="cardnumber" placeholder="1234 5678 9012 3456" required>
                    </div>
                    
                    <div style="display: flex; gap: 15px;">
                        <div style="flex: 1;" class="form-group">
                            <label for="expiry">Date d'expiration</label>
                            <input type="text" id="expiry" name="expiry" placeholder="MM/AA" required>
                        </div>
                        <div style="flex: 1;" class="form-group">
                            <label for="cvv">Cryptogramme</label>
                            <input type="text" id="cvv" name="cvv" placeholder="CVV" required>
                        </div>
                    </div>
                    
                    <div class="card-icons">
                        <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" alt="Visa">
                        <img src="https://cdn-icons-png.flaticon.com/512/196/196561.png" alt="Mastercard">
                        <img src="https://cdn-icons-png.flaticon.com/512/196/196566.png" alt="American Express">
                    </div>
                    
                    <div class="test-card">
                        <strong>Mode test activé :</strong><br>
                        Pour tester le paiement, utilisez :<br>
                        NOM: TEST<br>
                        N° carte: 5555 1234 5678 9000<br>
                        CVV: 555<br>
                        Date: toute date future
                    </div>
                    
                    <button type="submit" class="btn">Payer <?= $total ?> €</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?= date('Y') ?> Rajjel Agency. Tous droits réservés.</p>
            <p>Paiement sécurisé par CYBank</p>
        </div>
    </footer>
</body>
</html>
