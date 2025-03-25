<?php
session_start();

if (!isset($_SESSION["user"])) {
  header("Location: connexion.php"); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
  exit();
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alabasta Trek - Agence de Voyage</title>
  <link rel="stylesheet" href="acceuil.css">
</head>

<body>

  <nav class="barre-navigation">
    <ul class="lien-navigation">

      <img src="logo2.webp" class="logoRA">

      <li><a href="presentation.php" align="left"> Rajjel Agency </a></li>

    </ul>

    <input class="input" placeholder="Rechercher" type="search" value="">
    <a href="connexion.php" class="inscription">Connexion</a>
    <div class="user-menu">
      <a href="profil.php">
        <img src="usericon.jpg" alt="Profil utilisateur" class="user-icon">
      </a>
    </div>

  </nav>

  <div class="fond">
    <div class="fond-titre">
      <h1 class="titre">Alabasta Trek</h1>
      <p class="sous-titre">Découvrez l'aventure unique à travers les dunes du Sahara.</p>
      <a href="aventure.php" class="btn">Découvrez nos aventures</a>
    </div>
  </div>

  <h2 class="welcome-message">Bienvenue, <?php echo htmlspecialchars($_SESSION["user"]["prenom"]); ?> !</h2>
  <a href="deconnexion.php" class="logout-link">Déconnexion</a>
  <footer align="center">
    <div class="footer-container">
      <p>&copy; 2025 Rajjel Agency. Tous droits réservés.</p>
      <nav>
        <ul>
          <li><a href="presentation.php">Cliquez ici pour suivre notre présentation ou sur "Rajjel agency" en haut à gauche</a></li>
          <li>---------</li>
          <li><a href="/contact">Contact</a></li>
        </ul>
      </nav>
    </div>
    <a href="admin.php" class="btn">Page administrateur</a>
  </footer>


</body>

</php>