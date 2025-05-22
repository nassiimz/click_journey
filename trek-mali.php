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
    <title>Trek Mali | Rajjel Agency</title>
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
            <span class="nav-current"><i>🇲🇱</i> Trek Mali</span>
        </div>
    </nav>
    <header>
        <div class="container header-content">
            <h1>Trek au Pays Dogon, Mali</h1>
            <p>Explorez les falaises de Bandiagara et la culture Dogon</p>
        </div>
    </header>
    <div class="container">
        <form method="POST" action="trek-mali.php" class="trek-content">
            <div class="main-content">
                <section class="description">
                    <h2>Description du Trek</h2>
                    <p>Partez à la découverte du Pays Dogon, classé au patrimoine mondial de l’UNESCO. Randonnée entre villages troglodytes, falaises et traditions ancestrales.</p>
                </section>
                <section class="programme">
                    <h2>Programme détaillé</h2>
                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSO8V7wl_fLTS4m1GXfrWfEuVQw5GZHiG1Stg&s" alt="Falaises de Bandiagara" class="jour-img">
                        <div>
                            <h3>Jour 1 : Arrivée à Bamako</h3>
                            <p>Accueil à l’aéroport, transfert et nuit à Bamako.</p>
                        </div>
                    </div>
                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTHA2Ao2ANp-1_lecRe-rsewH7vQDuGSfdQw&s" alt="Village Dogon" class="jour-img">
                        <div>
                            <h3>Jour 2 : Départ vers Bandiagara</h3>
                            <p>Route vers les falaises, visite des villages Dogon et initiation à la culture locale.</p>
                        </div>
                    </div>
                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT10lb1bymROxZ625NjsLKkGpVlJ_nM4Hoq-A&s" alt="Randonnée Dogon" class="jour-img">
                        <div>
                            <h3>Jour 3 : Randonnée sur les falaises</h3>
                            <p>Marche entre les villages, découverte des greniers à mil et des masques traditionnels.</p>
                        </div>
                    </div>
                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3UnEucCYXZuIiy1wvfAz7mQBukLn2Wq7sDA&s" alt="Retour à Bamako" class="jour-img">
                        <div>
                            <h3>Jour 4 : Retour à Bamako</h3>
                            <p>Derniers échanges avec les habitants, retour à Bamako et fin du séjour.</p>
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