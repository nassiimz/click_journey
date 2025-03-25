<?php
session_start();

// Vérifier si l'utilisateur est bien administrateur (à adapter selon votre logique)
if (!isset($_SESSION["user"]) || $_SESSION["user"]["email"] !== "admin@exemple.com") {
    header("Location: connexion.php");
    exit();
}
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin") {
    header("Location: connexion.php"); // Redirection si pas admin
    exit();
}

$csvFile = "utilisateurs.csv";
$users = [];

// Charger les utilisateurs depuis le fichier CSV
if (($handle = fopen($csvFile, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $users[] = $data;
    }
    fclose($handle);
}

// Suppression d'un utilisateur
if (isset($_GET["delete"])) {
    $emailToDelete = $_GET["delete"];
    $newUsers = [];

    foreach ($users as $user) {
        if ($user[2] !== $emailToDelete) { // Comparaison avec l'email
            $newUsers[] = $user;
        }
    }

    // Réécriture du fichier CSV sans l'utilisateur supprimé
    $handle = fopen($csvFile, "w");
    foreach ($newUsers as $user) {
        fputcsv($handle, $user);
    }
    fclose($handle);

    header("Location: admin.php"); // Rafraîchir la page
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gestion des utilisateurs</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <h1>Tableau de bord Administrateur</h1>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= htmlspecialchars($user[0]) ?></td>
                    <td><?= htmlspecialchars($user[1]) ?></td>
                    <td><?= htmlspecialchars($user[2]) ?></td>
                    <td>
                        <a href="admin.php?delete=<?= urlencode($user[2]) ?>" onclick="return confirm('Supprimer cet utilisateur ?');">
                            Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="acceuil1.php" class="btn">Retour à l'accueil</a>

</body>

</html>