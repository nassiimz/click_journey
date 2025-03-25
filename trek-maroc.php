<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trek dans le Sahara marocain</title>
    <link rel="stylesheet" href="trek-tunisie.css">
</head>

<body>

    <h1>Trek dans le Sahara marocain</h1>


    <section class="trek-image">
        <img src="carte-trek-maroc.jpg" alt="Desert tunisien">
    </section>

    <section class="description">
        <p>Ce trek au cœur du Sahara marocain vous emmène à la découverte des paysages grandioses du désert, entre dunes majestueuses, oasis verdoyantes et montagnes arides du Djebel Bani, offrant une immersion totale dans la culture nomade et une expérience inoubliable sous les étoiles.</p>
    </section>

    <section class="programme">
        <h2>Programme du Trek</h2>
        <div class="programme-container">
            <div class="jour">
                <img src="draa.jpg" alt="Départ vers le désert">
                <p><u><strong>Jour 1 :</strong></u>Départ tôt le matin de Ouarzazate en passant par le col de Tizi’n-Tinififft (1680 m) avant de rejoindre la vallée du Drâa et ses palmeraies. Arrêt à Zagora pour découvrir son ambiance saharienne, puis continuation vers M’Hamid El Ghizlane, porte du désert, où commence l’immersion dans le Sahara marocain.</p>
            </div>
            <div class="jour">
                <img src="bivouac.webp" alt="Tassili n'Ajjer">
                <p><u><strong>Jour 2 :</strong></u> Départ à pied ou à dos de dromadaire pour traverser les premières dunes du désert en direction d’Erg Bourgueme. Continuation à travers les vastes étendues sablonneuses jusqu’à Erg Chegaga, l’un des plus grands massifs dunaires du Maroc, pour admirer un coucher de soleil spectaculaire. Nuit en bivouac sous les étoiles.</p>
            </div>
            <div class="jour">
                <img src="ergabidilya.jpg" alt="Dunes de l'Erg Admer">
                <p><u><strong>Jour 3 :</strong></u> Randonnée matinale à travers le désert en direction d’Oued El Attach, un point d’eau essentiel pour la faune locale. Poursuite du trek vers Erg Abidiliya, un paysage de dunes infinies et de silence absolu, offrant une expérience immersive unique au cœur du Sahara.</p>
            </div>
            <div class="jour">
                <img src="oasisaferdou.jpg" alt="Exploration des canyons">
                <p><u><strong>Jour 4 :</strong></u> Dernière journée de trek avec une traversée du Djebel Bani, offrant un contraste saisissant entre le désert et la montagne. Arrivée à l’Oasis d’Aferdou, un havre de fraîcheur entouré de palmiers. Retour en véhicule vers Ouarzazate en passant par la vallée du Drâa, avec une dernière vue sur les paysages envoûtants du désert marocain.</p>
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
            <input type="radio" name="billet" value="avec_agence"> Prendre le billet avec l'agence (+300€)
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