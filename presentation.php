<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Agence spécialisée dans les treks et expéditions dans le Sahara. Découvrez les paysages majestueux et la culture nomade.">
  <title>Rajjel Agency - Trekking dans le Sahara</title>
  <style>
    /* Styles généraux */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      color: #333;
      line-height: 1.6;
      background-color: #f9f9f9;
    }
    
    /* Section Présentation */
    .pres {
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1517825738774-7de9363ef735?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
      background-size: cover;
      min-height: 70vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      color: white;
      text-align: center;
    }
    
    .fond-texte {
      max-width: 800px;
      background-color: rgba(0, 0, 0, 0.7);
      padding: 2rem;
      border-radius: 10px;
    }
    
    .titre {
      font-size: 3rem;
      margin-bottom: 1rem;
      color: #e6b800;
      text-transform: uppercase;
      letter-spacing: 2px;
    }
    
    .sous-titre {
      font-size: 1.5rem;
      font-style: italic;
      margin-bottom: 2rem;
      color: #fff;
    }
    
    .texte {
      font-size: 1.1rem;
      margin-bottom: 1.5rem;
      text-align: justify;
    }
    
    /* Pied de page */
    .footer-container {
      background-color: #222;
      color: #fff;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    
    .contacts {
      max-width: 1000px;
      width: 100%;
      margin-bottom: 2rem;
    }
    
    .contacts h2 {
      color: #e6b800;
      text-align: center;
      margin-bottom: 1.5rem;
      font-size: 1.8rem;
    }
    
    .contact-info, .contact-details {
      display: inline-block;
      vertical-align: top;
      width: 48%;
      padding: 0 1%;
    }
    
    .contact-info p, .contact-details p {
      margin-bottom: 0.8rem;
    }
    
    strong {
      color: #e6b800;
    }
    
    .btn1 {
      display: inline-block;
      background-color: #e6b800;
      color: #222;
      padding: 0.8rem 1.5rem;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      transition: all 0.3s ease;
      margin-top: 1rem;
    }
    
    .btn1:hover {
      background-color: #ffd700;
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .contact-info, .contact-details {
        width: 100%;
        display: block;
      }
      
      .titre {
        font-size: 2rem;
      }
      
      .sous-titre {
        font-size: 1.2rem;
      }
    }
  </style>
</head>

<body>
  <div class="pres">
    <div class="fond-texte">
      <h1 class="titre">Rajjel Agency</h1>
      <p class="sous-titre">Laissez-vous envoûter par l'immensité du désert !</p>
      <p class="texte">
        <strong>Rajjel Agency</strong> est une agence spécialisée dans l'organisation de treks à travers les vastes étendues du Sahara. De la Tunisie au Maroc en passant par l'Algérie, nous offrons des aventures authentiques en immersion totale avec la nature et la culture nomade. Nos expéditions sont conçues pour vous faire découvrir la magie du désert, entre dunes majestueuses, oasis cachées et nuits étoilées inoubliables.
      </p>
    </div>
  </div>

  <footer class="footer-container">
    <section class="contacts">
      <h2>Contacts et Crédits</h2>
      <div class="contact-info">
        <p><strong>Direction & Organisation :</strong> Nassim</p>
        <p><strong>Guides et accompagnateurs :</strong> Nassim</p>
        <p><strong>Développement du site :</strong> Nassim</p>
        <p><strong>Graphisme & Design :</strong> Nassim</p>
        <p><strong>Partenaires :</strong> Nassim</p>
      </div>
      <div class="contact-details">
        <p><strong>Contact :</strong> contacte-nous@rajjel-agency.com</p>
        <p><strong>Adresse :</strong> 171 rue du charpentier, 95130 Franconville</p>
        <p><strong>Téléphone :</strong> +0000000001</p>
      </div>
    </section>
    <a href="acceuil1.php" class="btn1">Retour à l'accueil</a>
  </footer>
</body>

</html>