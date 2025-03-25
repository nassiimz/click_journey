<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trek à la découverte du désert tunisien</title>
    <link rel="stylesheet" href="trek-tunisie.css">
</head>

<body>

    <h1>Trek à la découverte du désert tunisien</h1>


    <section class="trek-image">
        <img src="carte-trek-tunisie.avif" alt="Desert tunisien">
    </section>

    <section class="description">
        <p>Ce trek en Tunisie vous emmène au cœur du Grand Erg Oriental, où vous traverserez des dunes dorées, découvrirez des oasis secrètes, partagerez des moments authentiques avec une famille nomade et admirerez des levers et couchers de soleil inoubliables sur le désert, le tout dans une immersion totale au rythme des caravanes sahariennes.</p>
    </section>

    <section class="programme">
        <h2>Programme du Trek</h2>
        <div class="programme-container">
            <div class="jour">
                <img src="douz.jpg" alt="Départ vers le désert">
                <p><u><strong>Jour 1 :</strong></u> Arrivée à Douz, porte du désert, et départ pour une immersion dans les premières dunes du Grand Erg Oriental avec installation du bivouac sous les étoiles.</p>
            </div>
            <div class="jour">
                <img src="oasis-nuit-tunsie.webp" alt="Tassili n'Ajjer">
                <p><u><strong>Jour 2 :</strong></u> Randonnée à travers les dunes dorées, observation de la faune du désert et pause déjeuner à l’ombre d’un tamaris avant d’atteindre une oasis cachée pour la nuit.</p>
            </div>
            <div class="jour">
                <img src="nomade.jpg" alt="Dunes de l'Erg Admer">
                <p><u><strong>Jour 3 :</strong></u> Rencontre avec une famille nomade berbère, partage de leur mode de vie, apprentissage des techniques de survie dans le désert et soirée autour d’un feu de camp.</p>
            </div>
            <div class="jour">
                <img src="lever-soleil.avif" alt="Exploration des canyons">
                <p><u><strong>Jour 4 :</strong></u> Ascension des dunes pour admirer un lever de soleil spectaculaire avant le retour progressif vers Douz et la fin du trek.</p>
            </div>
        </div>
    </section>

    <section class="tarifs">
        <h2>Tarifs</h2>
        <table>
            <tr>
                <th>Type de Trek</th>
                <th>Prix par personne</th>
                <th>Choix</th>
            </tr>
            <tr>
                <td>Trek standard (4 jours)</td>
                <td>300€</td>
                <td><input type="checkbox" name="choix-trek" value="standard"></td>
            </tr>
            <tr>
                <td>Trek premium avec guide privé</td>
                <td>645€</td>
                <td><input type="checkbox" name="choix-trek" value="premium"></td>
            </tr>
            <tr>
                <td>Trek luxe avec campement tout confort</td>
                <td>750€</td>
                <td><input type="checkbox" name="choix-trek" value="luxe"></td>
            </tr>
        </table>

        <div class="date-selection">
            <label for="date-depart"><strong>Choisissez votre date de départ :</strong></label>
            <input type="date" id="date-depart" name="date-depart">
        </div>

    </section>

    <section class="billet-avion">
        <h2>Option Billet d'Avion</h2>
        <label>
            <input type="radio" name="billet" value="avec_agence"> Prendre le billet avec l'agence (+220€)
        </label>
        <label>
            <input type="radio" name="billet" value="independant"> Acheter mon billet indépendamment
        </label>
    </section>

    <div class="nombre-personnes">
        <label for="nb-personnes"><strong>Nombre de personnes :</strong></label>
        <select id="nb-personnes" name="nb-personnes">
            <option value="1">1 personne</option>
            <option value="2">2 personnes</option>
            <option value="3">3 personnes</option>
            <option value="4">4 personnes</option>
            <option value="5">5 personnes</option>
            <option value="6">6 personnes</option>
            <option value="7">7 personnes</option>
            <option value="8">8 personnes</option>
            <option value="9">9 personnes</option>
            <option value="10">10 personnes</option>
        </select>
    </div>

    <footer>

        <a href="paiement.php" class="validation">Valider et procéder au paiement</a>
        <a href="aventure.php" class="btn">Retour</a>

    </footer>
</body>

</html>