<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trek à travers les dunes de sable algeriennes</title>
    <link rel="stylesheet" href="trek-algerie.css">
</head>

<body>

    <h1>Trek à travers les dunes de sable algériennes</h1>


    <section class="trek-image">
        <img src="carte-trek-algerie.jpg" alt="Dunes du Sahara algérien">
    </section>

    <section class="description">
        <p>Partez à l'aventure dans le Sahara algérien, un désert majestueux aux paysages variés. Découvrez les dunes infinies, les formations rocheuses spectaculaires et les traditions nomades.</p>
    </section>

    <section class="programme">
        <h2>Programme du Trek</h2>
        <div class="programme-container">
            <div class="jour">
                <img src="djanet.jpeg" alt="Départ vers le désert">
                <p><strong>Jour 1 :</strong> Arrivée à Djanet, rencontre avec l'équipe et départ vers le désert.</p>
            </div>
            <div class="jour">
                <img src="tassili.jpg" alt="Tassili n'Ajjer">
                <p><strong>Jour 2 :</strong> Randonnée dans le Tassili n'Ajjer, découverte des gravures rupestres.</p>
            </div>
            <div class="jour">
                <img src="ergadmer.jpg" alt="Dunes de l'Erg Admer">
                <p><strong>Jour 3 :</strong> Traversée des dunes de l'Erg Admer, nuit sous tente touareg.</p>
            </div>
            <div class="jour">
                <img src="canyon.jpg" alt="Exploration des canyons">
                <p><strong>Jour 4 :</strong> Exploration des canyons rocheux et retour à Djanet.</p>
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
            <input type="radio" name="billet" value="avec_agence"> Prendre le billet avec l'agence (+800€)
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
        <a href="paiement.html" class="validation">Valider et procéder au paiement</a>
        <a href="aventure.html" class="btn">Retour</a>

    </footer>
</body>

</html>