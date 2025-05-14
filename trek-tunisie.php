<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['reservation'] = [
        'destination' => 'Tunisie',  
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
    <title>Trek Tunisie | Rajjel Agency</title>
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
                        <img src="https://guide-voyage-tunisie.com/wp-content/uploads/2022/12/balade-a-dos-de-dromadaire4.webp" alt="Départ vers le désert" class="jour-img">
                        <div>
                            <h3>Jour 1 : Arrivée à Douz – Porte du désert</h3>
                            <p> Départ de Tozeur ou de l’aéroport le plus proche vers Douz, aux portes du Grand Erg Oriental. Première immersion dans le désert avec une randonnée chamelière au coucher du soleil. Installation dans un campement nomade sous les étoiles, soirée autour du feu avec musique traditionnelle et contes du désert.

                            </p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQs-KdvSmzdaLgf-JWZ1ubKdzrxcsAaH3deLw&s" alt="oasis et source" class="jour-img">
                        <div>
                            <h3>Jour 2 : Oasis et sources chaudes</h3>
                            <p>Traversée du mythique Chott el Jerid, lac salé aux reflets surnaturels. Cap vers Ksar Ghilane, oasis en plein désert entourée de dunes. Bain dans ses sources chaudes naturelles et visite des ruines du fort romain de Tisavar. Nuit en bivouac au bord des dunes.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://www.francetvinfo.fr/pictures/4-S00FO8vSUHOfaNlTaMFUXnEvM/1200x900/2019/11/27/phph7XG5c.jpg" alt="mont matmata chenini" class="jour-img">
                        <div>
                            <h3>Jour 3 : Culture troglodyte et villages berbères</h3>
                            <p> Départ matinal vers les montagnes de Matmata. Découverte des habitations troglodytiques encore habitées. Déjeuner chez l’habitant. L’après-midi, route vers Chenini, village berbère accroché à flanc de montagne. Balade au coucher du soleil. Nuit dans une maison d’hôtes traditionnelle.

                            </p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://www.allibert-trekking.com/iconographie/f1/PA1_desert-tunisien.jpg" alt="marches locaux" class="jour-img">
                        <div>
                            <h3>Jour 4 : Dunes et marchés locaux</h3>
                            <p>Randonnée dans les paysages lunaires autour de Douiret. Retour vers Douz avec arrêt dans un marché local : dégustation de dattes, découverte des épices et de l’artisanat local. Fin du circuit avec un dernier coucher de soleil sur les dunes.</p>
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
