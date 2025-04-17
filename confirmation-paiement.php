<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

// Vérifier les paramètres de retour CYBank
if (!isset($_POST['statut']) || !isset($_POST['control']) || !isset($_POST['transaction'])) {
    header('Location: aventure.php');
    exit();
}

// Valider le contrôle de sécurité
require('getapikey.php');
$vendeur = 'RAJJEL_A';
$api_key = getAPIKey($vendeur);

$expected_control = md5(
    $api_key . "#" . 
    $_POST['transaction'] . "#" . 
    $_POST['montant'] . "#" . 
    $_POST['vendeur'] . "#" . 
    $_POST['statut'] . "#"
);

if ($_POST['control'] !== $expected_control) {
    die("Erreur de sécurité lors de la confirmation du paiement");
}

// Enregistrer le statut du paiement en session
$_SESSION['paiement_statut'] = $_POST['statut'];
$_SESSION['paiement_transaction'] = $_POST['transaction'];
$_SESSION['paiement_montant'] = $_POST['montant'];

// Redirection selon le résultat
if ($_POST['statut'] === 'accepted') {
    header('Location: confirmation.php');
} else {
    header('Location: paiement-refuse.php');
}
exit();
?>
