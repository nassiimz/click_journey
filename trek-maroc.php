<?php
session_start();

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['reservation'] = [
        'destination' => 'Maroc',  // Ajoutez cette ligne pour stocker la destination
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
    <title>Trek Maroc | Rajjel Agency</title>
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
                <i>🇲🇦</i> Trek Maroc
            </span>
        </div>
    </nav>

    <header>
        <div class="container header-content">
            <h1>Trek dans le Sahara marocain</h1>
            <p>Découvrez les dunes dorées de Merzouga et l'immensité du désert</p>
        </div>
    </header>

    <div class="container">
        <form method="POST" action="trek-maroc.php" class="trek-content">
            <div class="main-content">
                <section class="description">
                    <h2>Description du Trek</h2>
                    <p>Ce trek de 5 jours au cœur du Sahara marocain vous emmène à la découverte des paysages grandioses du désert, entre dunes majestueuses, oasis verdoyantes et montagnes arides du Djebel Bani, offrant une immersion totale dans la culture nomade et une expérience inoubliable sous les étoiles.</p>
                </section>

                <section class="programme">
                    <h2>Programme détaillé</h2>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8Za7rGzboU20bz0SfBpyJHbLDVT8d5n81GA&s" alt="Ouarzazate, Maroc" class="jour-img">
                        <div>
                            <h3>Jour 1 : Arrivée à Ouarzazate</h3>
                            <p>Accueil à l'aéroport et transfert vers votre hébergement. Dîner et nuit à Ouarzazate, la "porte du désert". Préparation pour le départ du trek le lendemain matin.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://images.mnstatic.com/3e/d6/3ed6c81a03dfb6d9a12faacb2051458d.jpg" alt="Vallée du Drâa, Maroc" class="jour-img">
                        <div>
                            <h3>Jour 2 : Vallée du Drâa</h3>
                            <p>Départ de Ouarzazate en passant par le col de Tizi'n-Tinififft avant de rejoindre la vallée du Drâa et ses palmeraies. Arrêt à Zagora puis continuation vers M'Hamid El Ghizlane, porte du désert. Installation du bivouac et première nuit sous les étoiles.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/67/Erg_Chegaga.JPG" alt="Erg Chegaga, Maroc" class="jour-img">
                        <div>
                            <h3>Jour 3 : Erg Chegaga</h3>
                            <p>Départ à pied ou à dos de dromadaire pour traverser les premières dunes du désert en direction d'Erg Bourgueme. Continuation vers Erg Chegaga pour un coucher de soleil spectaculaire. Dîner et nuit en bivouac.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTj87cffalysKxYcj0dTzcw0jxDLQjpc-tDfQ&s" alt="Erg Abidiliya, Maroc" class="jour-img">
                        <div>
                            <h3>Jour 4 : Erg Abidiliya</h3>
                            <p>Randonnée matinale à travers le désert vers Oued El Attach. Poursuite du trek vers Erg Abidiliya, un paysage de dunes infinies et de silence absolu. Rencontre avec des nomades et découverte de leur mode de vie. Nuit en bivouac.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8Za7rGzboU20bz0SfBpyJHbLDVT8d5n81GA&s" alt="Retour à Ouarzazate, Maroc" class="jour-img">
                        <div>
                            <h3>Jour 5 : Retour à Ouarzazate</h3>
                            <p>Traversée du Djebel Bani et arrivée à l'Oasis d'Aferdou. Retour vers Ouarzazate avec une dernière vue sur les paysages envoûtants du désert marocain. Transfert à l'aéroport en fin de journée.</p>
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
                        <option value="standard">Trek standard (4 jours) - 990€</option>
                        <option value="premium">Trek premium avec guide privé - 1390€</option>
                        <option value="luxe">Trek luxe avec campement tout confort - 1690€</option>
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
                standard: 990,
                premium: 1390,
                luxe: 1690
            },
            flightPrice: 800
        });
    </script>
</body>

</html>