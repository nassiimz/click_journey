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

.nav-home, .nav-treks {
    color: var(--light);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 5px;
    transition: color 0.3s;
}

.nav-home:hover, .nav-treks:hover {
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
                        url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyio3PWBVBkCGPvkoDhbzQ9lJeGfKsIJebHQ&s') no-repeat center center/cover;
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .sidebar {
            background-color: var(--white);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
        
        th, td {
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
        
        .radio-group, .checkbox-group {
            margin: 15px 0;
        }
        
        .radio-group label, .checkbox-group label {
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
                        <img src="https://images.unsplash.com/photo-1587854787071-b67e5d43d724?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Départ vers le désert" class="jour-img">
                        <div>
                            <h3>Jour 1 : Arrivée à Djanet</h3>
                            <p> Départ du Caire vers Bahariya. Première immersion dans le désert avec visite des sources thermales et des vestiges gréco-romains de l'oasis..</p>
                        </div>
                    </div>
                    
                    <div class="programme-jour">
                        <img src="https://images.unsplash.com/photo-1587854691369-3a7f4df9b725?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Tassili n'Ajjer" class="jour-img">
                        <div>
                            <h3>Jour 2 : Randonnée dans le Tassili</h3>
                            <pExcursion vers le Désert Blanc et ses formations calcaires spectaculaires, sculptées par le vent. Nuit sous les étoiles dans ce paysage lunaire..</p>
                        </div>
                    </div>
                    
                    <div class="programme-jour">
                        <img src="https://images.unsplash.com/photo-1587854691369-3a7f4df9b725?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Dunes de l'Erg Admer" class="jour-img">
                        <div>
                            <h3>Jour 3 : Traversée des dunes</h3>
                            <p>Traversée vers Farafra et découverte de la vallée d'Agabat, ses canyons et ses dunes de sable blond. Rencontre avec les nomades du désert.</p>
                        </div>
                    </div>
                    
                    <div class="programme-jour">
                        <img src="https://images.unsplash.com/photo-1587854691369-3a7f4df9b725?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Exploration des canyons" class="jour-img">
                        <div>
                            <h3>Jour 4 : Exploration des canyons</h3>
                            <p> Dernière randonnée dans le désert Noir et ses collines volcaniques avant retour au Caire, avec arrêt aux temples perdus en bordure du Sahara</p>
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
