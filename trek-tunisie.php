<?php
session_start();

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['reservation'] = [
        'destination' => 'Tunisie',  // Assurez-vous que la destination est correctement définie
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
    <title>Trek Tunisie | Rajjel Agency</title>
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
                <i>🇩🇿</i> Trek Tunisie
            </span>
        </div>
    </nav>

    <header>
        <div class="container header-content">
            <h1>Trek à travers les dunes du sahara tunisien</h1>
            <p>Découvrez les paysages époustouflants du Tassili n'Ajjer</p>
        </div>
    </header>

    <div class="container">
        <form method="POST" action="trek-tunisie.php" class="trek-content">
            <div class="main-content">
                <section class="description">
                    <h2>Description du Trek</h2>
                    <p>"De Douz aux oasis secrètes, vivez l’aventure saharienne entre dunes mouvantes et nuits bercées par les chants bédouins."</p>
                </section>

                <section class="programme">
                    <h2>Programme détaillé</h2>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSuxyyNznfiS2qIFQtdpdkZmV7tQ_vGisJlgQ&s" alt="Douz, Tunisie" class="jour-img">
                        <div>
                            <h3>Jour 1 : Départ de Douz</h3>
                            <p>Départ de Douz, la porte du désert tunisien. Première randonnée à travers les dunes dorées et installation du campement pour une nuit sous les étoiles.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQu_q4P7kzXe_IOwmqYwQ1JDk7ihaEXsv7diw&s" alt="Ksar Ghilane, Tunisie" class="jour-img">
                        <div>
                            <h3>Jour 2 : Oasis de Ksar Ghilane</h3>
                            <p>Traversée du désert jusqu'à l'oasis de Ksar Ghilane. Baignade dans la source chaude naturelle et découverte de la palmeraie.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaSm5bel_SCQAJSBUxgDVc3zwKt-TvlpwKKQ&s" alt="Matmata, Tunisie" class="jour-img">
                        <div>
                            <h3>Jour 3 : Matmata et habitations troglodytiques</h3>
                            <p>Exploration des villages troglodytiques de Matmata, rencontre avec les habitants et découverte de leur mode de vie traditionnel.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8gxO3N6d6ITBoYqdmHUfyD5_SAnL7Wl2ikg&s" alt="Grand Erg Oriental, Tunisie" class="jour-img">
                        <div>
                            <h3>Jour 4 : Dunes du Grand Erg Oriental</h3>
                            <p>Randonnée matinale dans les dunes du Grand Erg Oriental, retour à Douz et visite du marché local aux épices.</p>
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
    <script>
        function calculatePrice() {
            const typeTrek = document.getElementById('type_trek');
            const billetAvion = document.querySelector('input[name="billet_avion"]:checked');
            const nbPersonnes = document.getElementById('nb_personnes');

            // Ne rien afficher si le type de trek n'est pas sélectionné
            if (!typeTrek.value) {
                document.getElementById('total-price').textContent = '0 €';
                return;
            }

            // Prix de base selon le type de trek
            let basePrice = 0;
            if (typeTrek.value === 'standard') {
                basePrice = 300;
            } else if (typeTrek.value === 'premium') {
                basePrice = 700;
            } else if (typeTrek.value === 'luxe') {
                basePrice = 1000;
            }

            // Ajouter le prix du billet d'avion si sélectionné
            let flightPrice = 0;
            if (billetAvion && billetAvion.value === 'avec_agence') {
                flightPrice = 800;
            }

            // Calculer le total
            const personnes = nbPersonnes ? parseInt(nbPersonnes.value) : 1;
            const total = (basePrice + flightPrice) * personnes;

            // Formatage du prix avec séparateur de milliers et espace insécable avant €
            const formattedTotal = total.toLocaleString('fr-FR') + ' €';

            // Afficher seulement le prix total
            document.getElementById('total-price').textContent = formattedTotal;
        }

        document.addEventListener('DOMContentLoaded', function() {
            calculatePrice();
            document.getElementById('type_trek').addEventListener('change', calculatePrice);
            document.querySelectorAll('input[name="billet_avion"]').forEach(radio => {
                radio.addEventListener('change', calculatePrice);
            });
            document.getElementById('nb_personnes').addEventListener('change', calculatePrice);
        });
    </script>
</body>

</html>