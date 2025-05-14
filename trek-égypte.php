<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['reservation'] = [
        'destination' => 'Égypte',
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
    <title>Trek Egypte | Rajjel Agency</title>
   <link rel="stylesheet" href="trek.css">
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
            <p>Découvrez les paysages époustouflants et variés du desert Egyptien</p>
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
                        <img src="https://www.petitfute.com/medias/mag/22494/originale/33941-que-faire-au-caire-en-egypte.jpg" alt="Départ vers le désert" class="jour-img">
                        <div>
                            <h3>Jour 1 : Arrivée au Caire</h3>
                            <p>Accueil à l’aéroport et transfert vers l’oasis de Bahariya. Première randonnée dans les palmeraies et découverte des sources chaudes naturelles.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6c/Desert_blanc.jpg" alt="Tassili n'Ajjer" class="jour-img">
                        <div>
                            <h3>Jour 2 : Exploration du Désert Blanc</h3>
                            <p>Départ en 4x4 vers le Désert Blanc. Randonnée au cœur des formations calcaires éblouissantes. Nuit sous tente au milieu de ce décor lunaire.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://deserts.fr/wp-content/uploads/2024/09/desert-noir-cover.webp" alt="Dunes de l'Erg Admer" class="jour-img">
                        <div>
                            <h3>Jour 3 : Vallée d'Agabat et Désert Noir</h3>
                            <p>Traversée de la vallée d’Agabat, célèbre pour ses dunes dorées et ses falaises blanches. Poursuite vers le désert Noir et ses montagnes basaltiques.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://photo.comptoir.fr/asset/guide/1612/599018-1260x630-place-talaat-harb-dans-le-centre-ville-le-caire-egypte.jpg" alt="Exploration des canyons" class="jour-img">
                        <div>
                            <h3>Jour 4 : Retour au Caire</h3>
                            <p>Balade matinale autour des dunes, puis retour vers le Caire avec une halte au marché local de Bahariya. Fin de l’aventure avec dîner traditionnel.</p>
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
