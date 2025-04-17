<?php
session_start();

// Liste des emails admin autorisés
$adminEmails = [
    "nassimizza@gmail.com",
    "nassimbouslimani@gmail.com",
    "nassimsefraoui@gmail.com"
];

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: connexion.php?redirect=admin.php");
    exit();
}

// Vérifie si l'email de l'utilisateur est dans la liste des admins
if (!in_array($_SESSION['user']['email'], $adminEmails)) {
    echo "Accès refusé. Cette page est réservée aux administrateurs.";
    exit();
}

// Lecture du fichier CSV
$csv_file = 'utilisateurs.csv';
$utilisateurs = [];

if (file_exists($csv_file)) {
    $file = fopen($csv_file, 'r');
    fgetcsv($file); // Ignorer l'en-tête
    while (($data = fgetcsv($file)) !== false) {
        $utilisateurs[] = $data; // $data[0]=Nom, $data[1]=Email, $data[3]=Statut (VIP, Normal...)
    }
    fclose($file);
}

// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $email = $_POST['email'] ?? '';

    // Trouver l'utilisateur par email
    foreach ($utilisateurs as &$user) {
        if ($user[1] === $email) {
            // Vérifier si l'utilisateur est admin
            if (in_array($user[1], $adminEmails)) {
                $user[3] = 'Admin'; // Empêcher le changement de statut si c'est un admin
            } else {
                switch ($action) {
                    case 'vip':
                        $user[3] = 'VIP'; // Changer le statut en VIP
                        break;
                    case 'ban':
                        $user[3] = 'Banni'; // Changer le statut en Banni
                        break;
                    case 'delete':
                        // Suppression de l'utilisateur du tableau
                        $index = array_search($user, $utilisateurs);
                        if ($index !== false) {
                            unset($utilisateurs[$index]);
                        }
                        break;
                }
            }
            break;
        }
    }

    // Réécrire le fichier CSV avec les modifications
    if (file_exists($csv_file)) {
        $file = fopen($csv_file, 'w');
        fputcsv($file, ['Nom', 'Email', 'Date', 'Statut']); // Réécrire l'en-tête
        foreach ($utilisateurs as $user) {
            fputcsv($file, $user);
        }
        fclose($file);
    }

    // Rediriger pour actualiser la page
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="admin.css?v=1.0">
</head>

<body>
    <div class="admin">
        <h1>Gestion des Utilisateurs</h1>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $index => $user): ?>
                    <?php
                    $nom = htmlspecialchars($user[0]);
                    $email = htmlspecialchars($user[1]);
                    $statut = isset($user[3]) ? htmlspecialchars($user[3]) : 'Normal';

                    // Forcer le statut à "Admin" si l'email est dans la liste
                    if (in_array($user[1], $adminEmails)) {
                        $statut = 'Admin';
                    }
                    ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $nom ?></td>
                        <td><?= $email ?></td>
                        <td class="etat"><?= $statut ?></td>
                        <td>
                            <?php if ($statut !== 'Admin'): ?>
                                <!-- Formulaire pour définir l'utilisateur comme VIP -->
                                <form action="admin.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="vip">
                                    <input type="hidden" name="email" value="<?= $email ?>">
                                    <button type="submit" class="vip">VIP</button>
                                </form>

                                <!-- Formulaire pour bannir l'utilisateur -->
                                <form action="admin.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="ban">
                                    <input type="hidden" name="email" value="<?= $email ?>">
                                    <button type="submit" class="ban">Bannir</button>
                                </form>

                                <!-- Formulaire pour supprimer l'utilisateur -->
                                <form action="admin.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="email" value="<?= $email ?>">
                                    <button type="submit" class="delete">Supprimer</button>
                                </form>
                            <?php else: ?>
                                <!-- Actions désactivées pour les admins -->
                                <em>Actions désactivées</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <footer>
        <a href="acceuil1.php" class="btn1">Retour à l'accueil</a>
    </footer>
</body>

</html>