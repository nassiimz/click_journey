<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['reservation'] = [
        'destination' => 'Maroc', 
        'type_trek' => $_POST['type_trek'],
        'date_depart' => $_POST['date_depart'],
        'billet_avion' => $_POST['billet_avion'],
        'nb_personnes' => $_POST['nb_personnes']
    ];


    if (
        !empty($_SESSION['reservation']['destination']) &&
        !empty($_SESSION['reservation']['type_trek']) &&
        !empty($_SESSION['reservation']['date_depart']) &&
        !empty($_SESSION['reservation']['billet_avion']) &&
        !empty($_SESSION['reservation']['nb_personnes'])
    ) {

        $file = fopen('reservations.csv', 'a'); 
        if ($file) {
      
            $reservation = [
                $_SESSION['reservation']['destination'],
                $_SESSION['reservation']['type_trek'],
                $_SESSION['reservation']['date_depart'],
                $_SESSION['reservation']['billet_avion'],
                $_SESSION['reservation']['nb_personnes']
            ];
     
            if (fputcsv($file, $reservation)) {
                echo 'Réservation enregistrée avec succès.';
            } else {
                echo 'Erreur lors de l\'écriture dans le fichier CSV.';
            }
            fclose($file);
        } else {
            echo 'Erreur lors de l\'ouverture du fichier CSV.';
        }
    }

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
    <link rel="stylesheet" href="trek.css">
    </style>
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
                    <p>Ce trek au cœur du Sahara marocain vous emmène à la découverte des paysages grandioses du désert, entre dunes majestueuses, oasis verdoyantes et montagnes arides du Djebel Bani, offrant une immersion totale dans la culture nomade et une expérience inoubliable sous les étoiles.</p>
                </section>

                <section class="programme">
                    <h2>Programme détaillé</h2>

                    <div class="programme-jour">
                        <img src="https://media.istockphoto.com/id/522323786/fr/photo/vall%C3%A9e-du-draa-de-ouarzazate.jpg?s=612x612&w=0&k=20&c=Co7218Iws5OXr6MUrwKc3fwuYeAVGW-naH7FE9Ps3ko=" alt="Vallée du Drâa" class="jour-img">
                        <div>
                            <h3>Jour 1 : Vallée du Drâa</h3>
                            <p>Départ de Ouarzazate en passant par le col de Tizi'n-Tinififft avant de rejoindre la vallée du Drâa et ses palmeraies. Arrêt à Zagora puis continuation vers M'Hamid El Ghizlane, porte du désert.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/06/71/f4/67.jpg" alt="Erg Chegaga" class="jour-img">
                        <div>
                            <h3>Jour 2 : Erg Chegaga</h3>
                            <p>Départ à pied ou à dos de dromadaire pour traverser les premières dunes du désert en direction d'Erg Bourgueme. Continuation vers Erg Chegaga pour un coucher de soleil spectaculaire.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://www.moroccancircuit.com/file85/lg/16992228_1506722369351857_463526401372302208_o.jpg" alt="Erg Abidiliya" class="jour-img">
                        <div>
                            <h3>Jour 3 : Erg Abidiliya</h3>
                            <p>Randonnée matinale à travers le désert vers Oued El Attach. Poursuite du trek vers Erg Abidiliya, un paysage de dunes infinies et de silence absolu.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://www.moroccancircuit.com/file61/lg/mhamid-oasis.jpg" alt="Oasis d'Aferdou" class="jour-img">
                        <div>
                            <h3>Jour 4 : Oasis d'Aferdou</h3>
                            <p>Traversée du Djebel Bani et arrivée à l'Oasis d'Aferdou. Retour vers Ouarzazate avec une dernière vue sur les paysages envoûtants du désert marocain.</p>
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
                        <option value="premium">Trek premium avec guide privé - 645€</option>
                        <option value="luxe">Trek luxe avec campement tout confort - 750€</option>
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
                            Prendre le billet avec l'agence (+300€)
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
                <a href="mentions-legales.php">Mentions légales</a>
                <a href="contact.php">Contact</a>
                <a href="cgv.php">CGV</a>
            </div>
        </div>
    </footer>
</body>

</html>
