<?php
session_start();


$transactionsFile = __DIR__ . '/data/transactions.json';


$transaction = $_POST['transaction'] ?? '';
$montant     = $_POST['montant'] ?? '';
$vendeur     = $_POST['vendeur'] ?? '';
$status      = $_POST['status'] ?? 'denied';
$control     = $_POST['control'] ?? '';


$paysSelectionne         = $_SESSION['pays_selectionne'] ?? 'Non sélectionné';
$dateDepart              = $_SESSION['departure-date'] ?? 'Non sélectionnée';
$nombrePersonnes         = $_SESSION['num_people'] ?? 'Non sélectionné';
$activites               = $_SESSION['activites_selectionnees'] ?? [];
$vol                     = $_SESSION['vol'] ?? 'Non sélectionné';
$hotel                   = $_SESSION['hotel'] ?? 'Non sélectionné';
$optionsSupplementaires  = $_SESSION['options_supplementaires'] ?? [];


$newTransaction = [
    'username'            => $_SESSION['username'] ?? 'unknown',
    'transaction'         => $transaction,
    'montant'             => $montant,
    'vendeur'             => $vendeur,
    'status'              => $status,
    'control'             => $control,
    'date'                => date('Y-m-d H:i:s'),
   
    'pays_selectionne'    => $paysSelectionne,
    'date_depart'         => $dateDepart,
    'nombre_personnes'    => $nombrePersonnes,
    'activites'           => $activites,
    'vol'                 => $vol,
    'hotel'               => $hotel,
    'options_supplementaires' => $optionsSupplementaires
];


if (file_exists($transactionsFile)) {
    $transactions = json_decode(file_POST_contents($transactionsFile), true);
    if (!is_array($transactions)) {
        $transactions = [];
    }
} else {
    $transactions = [];
}


$transactions[] = $newTransaction;


if (file_put_contents($transactionsFile, json_encode($transactions, JSON_PRETTY_PRINT))) {

    if ($status === 'denied') {
        header("Location: recap.php");
    } else {
        header("Location: profil.php");
    }
    exit();
} else {
    echo "Erreur lors de l'enregistrement de la transaction.";
}
?>
