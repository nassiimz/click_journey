<?php
session_start();

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['reservation'] = [
     'destination' => 'Algérie',
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
    <title>Trek Algérie | Rajjel Agency</title>
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
                        <img src="https://images.unsplash.com/photo-1587854787071-b67e5d43d724?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Départ vers le désert" class="jour-img">
                        <div>
                            <h3>Jour 1 : Arrivée à Djanet</h3>
                            <p>Rencontre avec l'équipe et départ vers le désert. Installation au campement et première nuit sous les étoiles.</p>
                        </div>
                    </div>
                    
                    <div class="programme-jour">
                        <img src="https://images.unsplash.com/photo-1587854691369-3a7f4df9b725?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Tassili n'Ajjer" class="jour-img">
                        <div>
                            <h3>Jour 2 : Randonnée dans le Tassili</h3>
                            <p>Découverte des gravures rupestres millénaires et des formations rocheuses uniques.</p>
                        </div>
                    </div>
                    
                    <div class="programme-jour">
                        <img src="https://images.unsplash.com/photo-1587854691369-3a7f4df9b725?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Dunes de l'Erg Admer" class="jour-img">
                        <div>
                            <h3>Jour 3 : Traversée des dunes</h3>
                            <p>Marche à travers les dunes de l'Erg Admer et nuit sous tente touareg traditionnelle.</p>
                        </div>
                    </div>
                    
                    <div class="programme-jour">
                        <img src="https://images.unsplash.com/photo-1587854691369-3a7f4df9b725?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" alt="Exploration des canyons" class="jour-img">
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
</body>
</html>
