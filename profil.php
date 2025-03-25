<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user"])) {
    header("Location: connexion.php");
    exit();
}

$user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="profil.css">
    <script src="https://kit.fontawesome.com/a4f4cc5542.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="pseudo">
                    <h2> <input value="<?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </h2>
                </div>
                <p class="status">Statut : Membre VIP</p>
            </div>

            <div class="profile-info">
                <div class="email">
                    <p><strong>Email :</strong>
                        <input type="text" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        <i class="fa-solid fa-envelope"></i>
                    </p>
                </div>
                <div class="mdp">
                    <p><strong>Mot de passe :</strong>
                        <input type="password" placeholder="Nouveau mot de passe">
                        <i class="fa-solid fa-lock"></i>
                    </p>
                </div>
                <p><strong>Date d'inscription :</strong> 12 janvier 2024</p> <!-- À récupérer si dispo -->
            </div>

            <div class="profile-actions">
                <a href="deconnexion.php" class="btn logout">Se déconnecter</a>
            </div>
        </div>
    </div>

</body>

<footer>
    <a href="acceuil1.php" class="btn1">Retour à l'accueil</a>
</footer>

</html>