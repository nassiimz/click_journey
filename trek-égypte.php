<?php
session_start();

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['reservation'] = [
        'destination' => 'Égypte',
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
    <title>Trek Egypte | Rajjel Agency</title>
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
                <i>🇩🇿</i> Trek Egyptes
            </span>
        </div>
    </nav>

    <header>
        <div class="container header-content">
            <h1>Trek à travers le désert d'égypte</h1>
            <p>Découvrez les paysages époustouflants du Tassili n'Ajjer</p>
        </div>
    </header>

    <div class="container">
        <form method="POST" action="trek-égypte.php" class="trek-content">
            <div class="main-content">
                <section class="description">
                    <h2>Description du Trek</h2>
                    <p>"Découvrez un Sahara minéral et fantastique, où les roches sculptées par le vent côtoient les oasis perdues, loin des pyramides et du tumulte du Nil."</p>
                </section>

                <section class="programme">
                    <h2>Programme détaillé</h2>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhslHt9M_B0vDYn9T9TKtk-GaXj4CdfeoHEQ&s" alt="Oasis de Bahariya, Égypte" class="jour-img">
                        <div>
                            <h3>Jour 1 : Oasis de Bahariya</h3>
                            <p>Départ du Caire vers l'oasis de Bahariya. Découverte des sources thermales, des palmeraies et des vestiges antiques de cette oasis emblématique du désert égyptien.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSO_mTd1UQ01865a64jTxs3HAXvcQEJr6snHQ&s" alt="Désert Blanc, Égypte" class="jour-img">
                        <div>
                            <h3>Jour 2 : Le Désert Blanc</h3>
                            <p>Excursion dans le Désert Blanc, célèbre pour ses formations calcaires spectaculaires sculptées par le vent. Nuit sous les étoiles dans ce paysage lunaire unique.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSU9gtl1uwKhf3iNG4kLI8tgW4SAw2khrzk8A&s" alt="Vallée d'Agabat, Égypte" class="jour-img">
                        <div>
                            <h3>Jour 3 : Vallée d'Agabat et Farafra</h3>
                            <p>Randonnée dans la vallée d'Agabat, entre canyons et dunes dorées, puis découverte de l'oasis de Farafra et de ses sources chaudes naturelles.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://deserts.fr/wp-content/uploads/2024/09/desert-noir-egypte.webp" alt="Désert Noir, Égypte" class="jour-img">
                        <div>
                            <h3>Jour 4 : Désert Noir et retour</h3>
                            <p>Exploration du Désert Noir et de ses collines volcaniques, puis retour vers Bahariya et transfert au Caire en fin de journée.</p>
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
                        <option value="standard">Trek standard (4 jours) - 300€</option>
                        <option value="premium">Trek premium avec guide privé - 700€</option>
                        <option value="luxe">Trek luxe avec campement tout confort - 1000€</option>
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
                    <div class="total-price" id="total-price">Prix&nbsp;: 0&nbsp;€</div>
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
                standard: 300,
                premium: 700,
                luxe: 1000
            },
            flightPrice: 800
        });
    </script>
</body>

</html>