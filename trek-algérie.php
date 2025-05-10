<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['reservation'] = [
        'destination' => 'Algérie',
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
    <title>Trek Algérie | Rajjel Agency</title>

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
                        <img src="https://www.sciencesetavenir.fr/assets/img/2023/08/18/cover-r4x3w1200-64def57329460-f659836efd0f0159ba21d489c89a5921851e4bd6-jpg.jpg" alt="Départ vers le désert" class="jour-img">
                        <div>
                            <h3>Jour 1 : Arrivée à Djanet</h3>
                            <p>Rencontre avec l'équipe et départ vers le désert. Installation au campement et première nuit sous les étoiles.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://odysseedelaterre.fr/wp-content/uploads/2023/12/parc-tassili-n-ajjer-algerie.jpg" alt="Tassili n'Ajjer" class="jour-img">
                        <div>
                            <h3>Jour 2 : Randonnée dans le Tassili</h3>
                            <p>Découverte des gravures rupestres millénaires et des formations rocheuses uniques.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://blog.kazaden.com/wp-content/uploads/2020/04/IMG_20200303_064744.jpg" alt="Dunes de l'Erg Admer" class="jour-img">
                        <div>
                            <h3>Jour 3 : Traversée des dunes</h3>
                            <p>Marche à travers les dunes de l'Erg Admer et nuit sous tente touareg traditionnelle.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://www.mahaara.fr/wp-content/uploads/2023/08/PSX_20230814_190717-1-scaled.jpg" alt="Exploration des canyons" class="jour-img">
                        <div>
                            <h3>Jour 4 : Exploration des canyons</h3>
                            <p>Dernière journée d'exploration avant le retour à Djanet en fin de journée.</p>
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
    <script src="js/theme.js"></script>
</body>

</html>