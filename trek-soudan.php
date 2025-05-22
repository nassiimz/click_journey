<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['reservation'] = [
        'destination' => 'Soudan',
        'type_trek' => $_POST['type_trek'],
        'date_depart' => $_POST['date_depart'],
        'billet_avion' => $_POST['billet_avion'],
        'nb_personnes' => $_POST['nb_personnes']
    ];

    if (isset($_SESSION['user'])) {
        header('Location: recap-reservation.php');
    } else {
        header('Location: connexion.php?redirect=recap-reservation.php');
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trek Soudan | Rajjel Agency</title>
    <link rel="stylesheet" href="trek.css?v=1.0">
    <link rel="stylesheet" id="theme-style">
    <script src="theme.js"></script>
</head>

<body>
    <nav class="trek-nav">
        <div class="container">
            <a href="acceuil1.php" class="nav-home"><i>🏠</i> Accueil</a>
            <span class="nav-separator">›</span>
            <a href="aventure.php" class="nav-treks"><i>🗺️</i> Nos Treks</a>
            <span class="nav-separator">›</span>
            <span class="nav-current"><i>🇸🇩</i> Trek Soudan</span>
        </div>
    </nav>
    <header>
        <div class="container header-content">
            <h1>Trek dans le désert de Nubie, Soudan</h1>
            <p>Explorez les pyramides méconnues et les rives du Nil</p>
        </div>
    </header>
    <div class="container">
        <form method="POST" action="trek-soudan.php" class="trek-content">
            <div class="main-content">
                <section class="description">
                    <h2>Description du Trek</h2>
                    <p>Partez à la découverte des pyramides de Méroé, des villages nubiens et du désert soudanais, loin des sentiers battus.</p>
                </section>
                <section class="programme">
                    <h2>Programme détaillé</h2>
                    <div class="programme-jour">
                        <img src="https://www.connaissancedesarts.com/wp-content/thumbnails/uploads/2010/03/83545_1269619497_haute-nubie-047-tt-width-650-height-630-fill-0-crop-1-bgcolor-ffffff.jpg" alt="Pyramides de Méroé" class="jour-img">
                        <div>
                            <h3>Jour 1 : Arrivée à Khartoum</h3>
                            <p>Accueil à l’aéroport, visite de la ville et nuit à Khartoum.</p>
                        </div>
                    </div>
                    <div class="programme-jour">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/57/Nubian_desert%2CWadi_Halfa.jpg" alt="Désert de Nubie" class="jour-img">
                        <div>
                            <h3>Jour 2 : Route vers Méroé</h3>
                            <p>Découverte des pyramides de Méroé et bivouac dans le désert.</p>
                        </div>
                    </div>
                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTl5KMJR_MlUwE3z7TSBYD-sb-JR9Y4jo-qLQ&s" alt="Village Nubien" class="jour-img">
                        <div>
                            <h3>Jour 3 : Rencontre avec les Nubiens</h3>
                            <p>Visite de villages traditionnels et navigation sur le Nil.</p>
                        </div>
                    </div>
                    <div class="programme-jour">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b2/Sunset_Khartoum.jpg" alt="Retour à Khartoum" class="jour-img">
                        <div>
                            <h3>Jour 4 : Retour à Khartoum</h3>
                            <p>Derniers achats au marché, transfert à l’aéroport.</p>
                        </div>
                    </div>
                </section>
            </div>
            <div class="sidebar">
                <h2>Réserver ce trek</h2>
                <div class="form-group">
                    <label for="type_trek">Type de Trek</label>
                    <select id="type_trek" name="type_trek" required>
                        <option value="">-- Sélectionnez --</option>
                        <option value="standard">Trek standard (4 jours) - 1050€</option>
                        <option value="premium">Trek premium avec guide privé - 1450€</option>
                        <option value="luxe">Trek luxe avec campement tout confort - 1750€</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_depart">Date de départ</label>
                    <input type="date" id="date_depart" name="date_depart" required min="<?= date('Y-m-d', strtotime('+1 week')) ?>">
                </div>
                <div class="form-group">
                    <label>Option Billet d'Avion</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="billet_avion" value="avec_agence" required>
                            Prendre le billet avec l'agence (+800€)
                        </label>
                        <label>
                            <input type="radio" name="billet_avion" value="independant">
                            Acheter mon billet indépendamment
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nb_personnes">Nombre de personnes</label>
                    <select id="nb_personnes" name="nb_personnes" required>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?> personne<?= $i > 1 ? 's' : '' ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="price-summary">
                    <h3>Prix total</h3>
                    <div class="total-price" id="total-price">0€</div>
                </div>
                <button type="submit" class="btn btn-block">
                    <?= isset($_SESSION['user']) ? 'Confirmer la réservation' : 'Se connecter pour réserver' ?>
                </button>
                <a href="aventure.php" class="btn btn-block" style="background-color: var(--dark); margin-top: 10px;">
                    Retour aux treks
                </a>
            </div>
        </form>
    </div>
    <footer>
        <div class="container">
            <p>&copy; <?= date('Y') ?> Rajjel Agency. Tous droits réservés.</p>
            <div class="footer-links">
                <a>Mentions légales</a>
                <a>Contact</a>
                <a>CGV</a>
            </div>
        </div>

    </footer>
    <script src="calculate-price.js"></script>
    <script>
        setupPriceCalculation({
            basePrices: {
                standard: 1050,
                premium: 1450,
                luxe: 1750
            },
            flightPrice: 800
        });
    </script>
</body>

</html>