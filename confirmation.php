<?php
session_start();
require('getapikey.php');

// Vérification des paramètres
if (!isset($_GET['statut'], $_GET['control'], $_GET['transaction'])) {
    die("Paramètres manquants");
}

// Validation du contrôle
$vendeur = $_GET['vendeur'];
$api_key = getAPIKey($vendeur);
$expected = md5($api_key."#".$_GET['transaction']."#".$_GET['montant']."#".$vendeur."#".$_GET['statut']."#");

if ($_GET['control'] !== $expected) {
    die("Erreur de sécurité");
}

// Traitement selon le statut
$paiement_ok = ($_GET['statut'] === 'accepted');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
    <!-- Styles similaires à paiement.php -->
</head>
<body>
    <div class="container">
        <?php if ($paiement_ok): ?>
            <h1>✅ Paiement accepté</h1>
            <p>Votre réservation est confirmée !</p>
        <?php else: ?>
            <h1>❌ Paiement refusé</h1>
            <p>Veuillez réessayer ou contacter votre banque.</p>
        <?php endif; ?>
        <a href="aventure.php" class="btn">Retour</a>
    </div>
</body>
</html>
