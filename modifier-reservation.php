<?php
session_start();

if (!isset($_SESSION['reservation'])) {
    header('Location: aventure.php');
    exit();
}

// Pré-remplir le formulaire avec les données existantes
$reservation = $_SESSION['reservation'];
?>

<!-- Formulaire pré-rempli -->
<select name="type_trek" id="type_trek" required>
    <option value="standard" <?= $reservation['type_trek'] === 'standard' ? 'selected' : '' ?>>Trek standard</option>
    <option value="premium" <?= $reservation['type_trek'] === 'premium' ? 'selected' : '' ?>>Trek premium</option>
    <option value="luxe" <?= $reservation['type_trek'] === 'luxe' ? 'selected' : '' ?>>Trek luxe</option>
</select>