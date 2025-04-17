<?php
session_start();

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sauvegarde des informations dans la session
    $_SESSION['reservation'] = [
        'destination' => 'Mauritanie', // Assurez-vous que la destination est correctement définie
        'type_trek' => $_POST['type_trek'],
        'date_depart' => $_POST['date_depart'],
        'billet_avion' => $_POST['billet_avion'],
        'nb_personnes' => $_POST['nb_personnes']
    ];

    // Vérifier si toutes les données nécessaires sont présentes
    if (
        !empty($_SESSION['reservation']['destination']) &&
        !empty($_SESSION['reservation']['type_trek']) &&
        !empty($_SESSION['reservation']['date_depart']) &&
        !empty($_SESSION['reservation']['billet_avion']) &&
        !empty($_SESSION['reservation']['nb_personnes'])
    ) {
        // Enregistrer la réservation dans un fichier CSV
        $file = fopen('reservations.csv', 'a'); // Ouvre le fichier en mode ajout
        if ($file) {
            // Ajouter les données dans le fichier CSV
            $reservation = [
                $_SESSION['reservation']['destination'],
                $_SESSION['reservation']['type_trek'],
                $_SESSION['reservation']['date_depart'],
                $_SESSION['reservation']['billet_avion'],
                $_SESSION['reservation']['nb_personnes']
            ];
            // Ajouter une ligne au fichier CSV
            if (fputcsv($file, $reservation)) {
                echo 'Réservation enregistrée avec succès.';
            } else {
                echo 'Erreur lors de l\'écriture dans le fichier CSV.';
            }
            fclose($file); // Fermer le fichier après l'écriture
        } else {
            echo 'Erreur lors de l\'ouverture du fichier CSV.';
        }

        // Vérification si l'utilisateur est connecté
        if (isset($_SESSION['user'])) {
            // Redirection vers la page récapitulative
            header('Location: recap-reservation.php');
        } else {
            // Si l'utilisateur n'est pas connecté, redirection vers la page de connexion
            header('Location: connexion.php?redirect=recap-reservation.php');
        }
        exit();
    } else {
        echo 'Erreur : une ou plusieurs données de réservation sont manquantes.';
    }
}
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trek Mauritanie | Rajjel Agency</title>
    <style>
        /* Nouvelle navigation */
        .trek-nav {
            background-color: var(--dark);
            padding: 15px 0;
            color: var(--light);
            font-size: 0.95rem;
        }

        .trek-nav .container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-home,
        .nav-treks {
            color: var(--light);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: color 0.3s;
        }

        .nav-home:hover,
        .nav-treks:hover {
            color: var(--primary);
        }

        .nav-current {
            color: var(--primary);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .nav-separator {
            color: rgba(255, 255, 255, 0.5);
            font-size: 1.2rem;
            line-height: 1;
        }

        /* Adaptez le header pour qu'il touche la nouvelle nav */
        header {
            margin-top: 0;
        }

        :root {
            --primary: #E67E22;
            --secondary: #D35400;
            --dark: #2C3E50;
            --light: #F5D29C;
            --white: #FFFFFF;
            --gray: #F5F5F5;
            --text: #333333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--gray);
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('data:image/jpeg;base64,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') no-repeat center center/cover;
            height: 60vh;
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--white);
            position: relative;
        }

        .header-content {
            width: 100%;
            z-index: 2;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: var(--light);
        }

        .breadcrumb {
            padding: 15px 0;
            background-color: var(--dark);
            color: var(--white);
        }

        .breadcrumb a {
            color: var(--light);
            text-decoration: none;
        }

        .trek-content {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 40px;
            margin: 40px 0;
        }

        .main-content {
            background-color: var(--white);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            background-color: var(--white);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }

        h2 {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 2rem;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
        }

        h3 {
            color: var(--dark);
            margin: 20px 0 10px;
        }

        p {
            margin-bottom: 15px;
        }

        .programme-jour {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 20px;
            margin-bottom: 30px;
            align-items: center;
        }

        .jour-img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: var(--primary);
            color: var(--white);
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        input[type="date"],
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .radio-group,
        .checkbox-group {
            margin: 15px 0;
        }

        .radio-group label,
        .checkbox-group label {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            cursor: pointer;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 10px;
        }

        .btn {
            display: inline-block;
            background-color: var(--primary);
            color: var(--white);
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: var(--secondary);
        }

        .btn-block {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }

        footer {
            background-color: var(--dark);
            color: var(--white);
            padding: 30px 0;
            text-align: center;
            margin-top: 40px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .footer-links a {
            color: var(--light);
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .trek-content {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 2rem;
            }

            .programme-jour {
                grid-template-columns: 1fr;
            }
        }
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
                <i>🇲🇦</i> Trek Mauritanie
            </span>
        </div>
    </nav>

    <header>
        <div class="container header-content">
            <h1>Trek dans le Sahara de Mauritanie</h1>
            <p>"Marchez dans le sable des caravanes millénaires, entre les dunes de l’Adrar et les cités mystérieuses de Chinguetti et Ouadane, gardiennes des savoirs du désert."</p>
        </div>
    </header>

    <div class="container">
        <form method="POST" action="trek-mauritanie.php" class="trek-content">
            <div class="main-content">
                <section class="description">
                    <h2>Description du Trek</h2>
                    <p>Dunes de l'Adrar et anciennes cités caravanières</p>
                </section>

                <section class="programme">
                    <h2>Programme détaillé</h2>

                    <div class="programme-jour">
                        <img src="https://images.unsplash.com/photo-1518630382440-eba68df79c1e?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Vallée du Drâa" class="jour-img">
                        <div>
                            <h3>Jour 1 : Vallée du Drâa</h3>
                            <p>Arrivée à Atar, départ pour Chinguetti. Découverte des bibliothèques anciennes et des maisons en pierre ocre de cette ville classée à l'UNESCO, porte d'entrée du désert.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://images.unsplash.com/photo-1518630382440-eba68df79c1e?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Erg Chegaga" class="jour-img">
                        <div>
                            <h3>Jour 2 : Erg Chegaga</h3>
                            <p> Randonnée vers l'erg Amatlich, premières dunes impressionnantes. Nuit sous tente nomade après une journée à parcourir les paysages lunaires du plateau désertique.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://images.unsplash.com/photo-1518630382440-eba68df79c1e?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Erg Abidiliya" class="jour-img">
                        <div>
                            <h3>Jour 3 : Erg Abidiliya</h3>
                            <p> Traversée vers Ouadane, autre joyau caravanier. Exploration des ruines de la vieille ville et des puits traditionnels encore utilisés par les nomades.</p>
                        </div>
                    </div>

                    <div class="programme-jour">
                        <img src="https://images.unsplash.com/photo-1518630382440-eba68df79c1e?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Oasis d'Aferdou" class="jour-img">
                        <div>
                            <h3>Jour 4 : Oasis d'Aferdou</h3>
                            <p> Ascension du plateau de l'Adrar pour un panorama à couper le souffle sur l'immensité saharienne avant retour vers Atar..</p>
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