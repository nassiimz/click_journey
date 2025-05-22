<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Agence spécialisée dans les treks et expéditions dans le Sahara. Découvrez les paysages majestueux et la culture nomade.">
  <title>Rajjel Agency - Trekking dans le Sahara</title>
  <link rel="stylesheet" id="theme-style">
  <script src="theme.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #E67E22;
      --secondary: #D35400;
      --dark: #2C3E50;
      --light: #ECF0F1;
      --gold: #E67E22;
    }

    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      color: #333;
      line-height: 1.6;
      background-color: #f9f9f9;
    }

    .hero-presentation {
      position: relative;
      height: 70vh;
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url('https://images.pexels.com/photos/998653/pexels-photo-998653.jpeg?cs=srgb&dl=pexels-francesco-ungaro-998653.jpg&fm=jpg') no-repeat center center/cover;
      backdrop-filter: blur(10px);

      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
    }

    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 800px;
      padding: 0 20px;
    }

    .hero-content h1 {
      font-family: 'Playfair Display', serif;
      font-size: 3.5rem;
      margin-bottom: 1rem;
      color: var(--gold);
      text-transform: uppercase;
      letter-spacing: 2px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .hero-subtitle {
      font-size: 1.5rem;
      margin-bottom: 2rem;
      font-style: italic;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    .presentation-content {
      padding: 60px 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .presentation-text {
      background: white;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      margin-bottom: 40px;
    }

    .presentation-text p {
      font-size: 1.1rem;
      line-height: 1.8;
      margin-bottom: 1.5rem;
    }

    .presentation-text strong {
      color: var(--primary);
      font-weight: 600;
    }

    .team-section {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-top: 40px;
    }

    .team-card {
      background: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .team-card:hover {
      transform: translateY(-10px);
    }

    .team-image {
      height: 300px;
      background-size: cover;
      background-position: center;
    }

    .team-info {
      padding: 20px;
    }

    .team-info h3 {
      color: var(--dark);
      margin-top: 0;
      font-size: 1.3rem;
    }

    .team-info p {
      color: #666;
      font-size: 0.9rem;
    }

    .btn {
      display: inline-block;
      background: var(--primary);
      color: white;
      padding: 12px 25px;
      border-radius: 4px;
      text-decoration: none;
      font-weight: bold;
      transition: all 0.3s ease;
      margin-top: 20px;
    }

    .btn:hover {
      background: var(--secondary);
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .footer-container {
      background-color: var(--dark);
      color: white;
      padding: 3rem 2rem;
      text-align: center;
    }

    .contacts-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      max-width: 1000px;
      margin: 0 auto 2rem;
    }

    .contact-col h2 {
      color: var(--gold);
      margin-bottom: 1.5rem;
      font-size: 1.5rem;
    }

    .contact-col p {
      margin-bottom: 0.8rem;
    }

    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 2.5rem;
      }

      .hero-subtitle {
        font-size: 1.2rem;
      }

      .presentation-text {
        padding: 20px;
      }
    }
  </style>
</head>

<body>
  <!-- Hero Section -->
  <section class="hero-presentation">
    <div class="hero-content">
      <h1>Rajjel Agency</h1>
      <div class="test"></div>
      <p class="hero-subtitle">Laissez-vous envoûter par l'immensité du désert !</p>
    </div>
  </section>

  <!-- Presentation Content -->
  <div class="presentation-content">
    <div class="presentation-text">
      <p>
        <strong>Rajjel Agency</strong> est une agence spécialisée dans l'organisation de treks à travers les vastes étendues du Sahara. De la Tunisie au Maroc en passant par l'Algérie, nous offrons des aventures authentiques en immersion totale avec la nature et la culture nomade. Nos expéditions sont conçues pour vous faire découvrir la magie du désert, entre dunes majestueuses, oasis cachées et nuits étoilées inoubliables.
      </p>

      <p>
        Fondée en 2010 par des passionnés du désert, notre agence s'est rapidement imposée comme une référence pour les voyageurs en quête d'authenticité. Nous travaillons en étroite collaboration avec les communautés locales pour vous offrir une expérience respectueuse de l'environnement et des traditions.
      </p>

      <a href="aventure.php" class="btn">Découvrez nos treks</a>
    </div>

    <div class="team-section">
      <div class="team-card">
        <div class="team-image" style="background-image: url('ekip.jpg');"></div>
        <div class="team-info">
          <h3>Notre Équipe</h3>
          <p>Des guides expérimentés et passionnés par le désert, issus des communautés locales, vous accompagnent pour une expérience inoubliable.</p>
        </div>
      </div>

      <div class="team-card">
        <div class="team-image" style="background-image: url('https://th.bing.com/th/id/R.5d21797e9a96c38c65060faed3703e27?rik=zy4wqh2YbZ7kVg&pid=ImgRaw&r=0');"></div>
        <div class="team-info">
          <h3>Notre Philosophie</h3>
          <p>Tourisme responsable et respect des écosystèmes fragiles du désert sont au cœur de nos préoccupations.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer-container">
    <div class="contacts-grid">
      <div class="contact-col">
        <h2>Direction & Organisation</h2>
        <p>Nassim</p>
        <p>Guides et accompagnateurs : Nassim</p>
      </div>

      <div class="contact-col">
        <h2>Développement & Design</h2>
        <p>Développement du site : Nassim</p>
        <p>Graphisme & Design : Nassim</p>
        <p>Partenaires : Nassim</p>
      </div>

      <div class="contact-col">
        <h2>Contact</h2>
        <p>contact@rajjel-agency.com</p>
        <p>171 rue du charpentier, 95130 Franconville</p>
        <p>+0000000001</p>
      </div>
    </div>

    <a href="acceuil1.php" class="btn">Retour à l'accueil</a>
  </footer>
</body>

</html>