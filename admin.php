<?php
session_start();


$adminEmails = [
    "nassimizza@gmail.com",
    "nassimbouslimani@gmail.com",
    "nassimsefraoui@gmail.com"
];


if (!isset($_SESSION['user'])) {
    header("Location: connexion.php?redirect=admin.php");
    exit();
}

if (!in_array($_SESSION['user']['email'], $adminEmails)) {
    echo "Accès refusé. Cette page est réservée aux administrateurs.";
    exit();
}


$csv_file = 'utilisateurs.csv';
$utilisateurs = [];

if (file_exists($csv_file)) {
    $file = fopen($csv_file, 'r');
    fgetcsv($file); 
    while (($data = fgetcsv($file)) !== false) {
        $utilisateurs[] = $data; 
    }
    fclose($file);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $email = $_POST['email'] ?? '';

    
    foreach ($utilisateurs as &$user) {
        if ($user[1] === $email) {
        
            if (in_array($user[1], $adminEmails)) {
                $user[3] = 'Admin'; 
            } else {
                switch ($action) {
                    case 'vip':
                        $user[3] = 'VIP'; 
                        break;
                    case 'ban':
                        $user[3] = 'Banni'; 
                        break;
                    case 'delete':
                        
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

    
    if (file_exists($csv_file)) {
        $file = fopen($csv_file, 'w');
        fputcsv($file, ['Nom', 'Email', 'Date', 'Statut']); 
        foreach ($utilisateurs as $user) {
            fputcsv($file, $user);
        }
        fclose($file);
    }


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
                              
                                <form action="admin.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="vip">
                                    <input type="hidden" name="email" value="<?= $email ?>">
                                    <button type="submit" class="vip">VIP</button>
                                </form>

                         
                                <form action="admin.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="ban">
                                    <input type="hidden" name="email" value="<?= $email ?>">
                                    <button type="submit" class="ban">Bannir</button>
                                </form>

                             
                                <form action="admin.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="email" value="<?= $email ?>">
                                    <button type="submit" class="delete">Supprimer</button>
                                </form>
                            <?php else: ?>
                              
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
