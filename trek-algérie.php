<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['reservation'] = [
        'destination' => 'Mali',
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
    <title>Trek Algérie | Rajjel Agency</title>
    <link rel="stylesheet" href="trek.css?v=1.0">
    <link rel="stylesheet" id="theme-style">
    <script src="theme.js"></script>
</head>

<body>
    <nav class="trek-nav">
        <div class="container">
            <a href="acceuil1.php" class="nav-home">
                <i>🏠</i> Accueil
            </a>
            <span class="nav-separator">›</span>
            <a href="aventure.php" class="nav-treks">
                <i>🗺️</i> Nos Treks
            </a>
            <span class="nav-separator">›</span>
            <span class="nav-current">
                <i>🇩🇿</i> Trek Algérie
            </span>
        </div>
    </nav>

    <header>
        <div class="container header-content">
            <h1>Trek à travers les dunes algériennes</h1>
            <p>Découvrez les paysages époustouflants du Tassili n'Ajjer</p>
        </div>
    </header>

    <div class="container">
        <form method="POST" action="trek-algérie.php" class="trek-content">
            <div class="main-content">
                <section class="description">
                    <h2>Description du Trek</h2>
                    <p>Partez à l'aventure dans le Sahara algérien, un désert majestueux aux paysages variés. Découvrez les dunes infinies, les formations rocheuses spectaculaires et les traditions nomades.</p>
                </section>

                <section class="programme">
                    <h2>Programme détaillé</h2>

                    <div class="programme-jour">
                        <img src="data:image/jpeg;base64,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" alt="Djanet, Algérie" class="jour-img">
                        <div>
                            <h3>Jour 1 : Arrivée à Djanet</h3>
                            <p>Rencontre avec l'équipe et installation au campement. Découverte de la ville-oasis de Djanet, porte d'entrée du Tassili n'Ajjer.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIjtMKE7sKDB0Y8nNyIvvohSJq1knl-Cu5_Q&s" alt="Tassili n'Ajjer, Algérie" class="jour-img">
                        <div>
                            <h3>Jour 2 : Tassili n'Ajjer</h3>
                            <p>Randonnée dans le massif du Tassili n'Ajjer, célèbre pour ses peintures rupestres et ses paysages lunaires.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSdj-nZtyu7pb3zonlVAhCiIq5WLwsRnMqOrg&s" alt="Erg Admer, Algérie" class="jour-img">
                        <div>
                            <h3>Jour 3 : Dunes de l'Erg Admer</h3>
                            <p>Traversée des grandes dunes de l'Erg Admer, expérience du désert saharien et nuit sous tente touareg.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFAKVtkXSWf7ImbOFENZHWqZrUbzOXd0GYEg&s" alt="Canyon du Tassili, Algérie" class="jour-img">
                        <div>
                            <h3>Jour 4 : Canyon du Tassili</h3>
                            <p>Exploration des canyons du Tassili, paysages spectaculaires et oasis cachées au cœur du désert.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://i.pinimg.com/736x/37/5b/2b/375b2b094c06ae6e19a59476dc1c5bfe.jpg" alt="Plateau du Tassili, Algérie" class="jour-img">
                        <div>
                            <h3>Jour 5 : Plateau du Tassili</h3>
                            <p>Ascension du plateau du Tassili pour admirer un panorama exceptionnel sur l'immensité saharienne.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjCLuy6ADHGo5gOb0BBPq4r1PxIn_Rd46WpA&s" alt="Oasis de Djanet, Algérie" class="jour-img">
                        <div>
                            <h3>Jour 6 : Oasis de Djanet</h3>
                            <p>Découverte d'une oasis verdoyante, détente et rencontre avec les habitants nomades.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS5COy0qrU8_Zl_BauI5fRzfPwoYYmZh6OQA&s" alt="Retour à Djanet, Algérie" class="jour-img">
                        <div>
                            <h3>Jour 7 : Retour à Djanet</h3>
                            <p>Dernière marche à travers les paysages désertiques avant le retour à Djanet et transfert à l'aéroport.</p>
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
                        <option value="standard">Trek standard (4 jours) - 980€</option>
                        <option value="premium">Trek premium avec guide privé - 1380€</option>
                        <option value="luxe">Trek luxe avec campement tout confort - 1680€</option>
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
                standard: 980,
                premium: 1380,
                luxe: 1680
            },
            flightPrice: 800
        });
    </script>
</body>

</html>