<nav class="navbar">
    <div class="container">
        <a href="acceuil1.php" class="logo">
            <img src="images/logo.png" alt="Rajjel Agency">
        </a>
        <ul class="nav-menu">
            <li><a href="acceuil1.php">Accueil</a></li>
            <li><a href="aventure.php">Nos Treks</a></li>
            <li><a href="presentation.php">Présentation</a></li>

            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="profil.php" class="btn-nav">Mon Compte</a></li>
            <?php else: ?>
                <li><a href="connexion.php" class="btn-nav">Mon compte</a></li>
            <?php endif; ?>

            <!-- Sélecteur thème -->
            <li>
                <button id="theme-toggle" class="btn-nav">🎨 Thème</button>
            </li>

            <!-- Sélecteur de taille de texte -->
            <li>
                <select id="font-size-selector" class="btn-nav">
                    <option value="normal">Aa</option>
                    <option value="medium">Aa+</option>
                    <option value="large">Aa++</option>
                </select>
            </li>
        </ul>
    </div>
</nav>