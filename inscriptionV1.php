<?php
// Démarrer la session
session_start();

// Chemin du fichier CSV
$csv_file = 'utilisateurs.csv';

// Créer le fichier s'il n'existe pas
if (!file_exists($csv_file)) {
    file_put_contents($csv_file, "nom,email,mot_de_passe\n");
}

// Traitement du formulaire
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';
    $confirmation = $_POST['confirmation'] ?? '';

    // Validation
    if (empty($nom) || empty($email) || empty($mot_de_passe) || empty($confirmation)) {
        $message = 'Tous les champs sont obligatoires.';
    } elseif ($mot_de_passe !== $confirmation) {
        $message = 'Les mots de passe ne correspondent pas.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email invalide.';
    } else {
        // Vérifier si l'email existe déjà
        $file = fopen($csv_file, 'r');
        $email_existe = false;
        while (($data = fgetcsv($file)) !== FALSE) {
            if ($data[1] === $email) {
                $email_existe = true;
                break;
            }
        }
        fclose($file);

        if ($email_existe) {
            $message = 'Cet email est déjà utilisé.';
        } else {
            // Hacher le mot de passe
            $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
            
            // Ajouter au fichier CSV
            $file = fopen($csv_file, 'a');
            fputcsv($file, [$nom, $email, $mot_de_passe_hash]);
            fclose($file);
            
            $message = 'Inscription réussie!';
            header("Refresh: 2; url=connexion.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            margin: 15px 0;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }
        .success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .error {
            background-color: #f2dede;
            color: #a94442;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        
        <?php if ($message): ?>
            <div class="message <?= strpos($message, 'réussie') !== false ? 'success' : 'error' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        
        <form method="post">
            <div class="form-group">
                <label for="nom">Nom complet</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>
            
            <div class="form-group">
                <label for="confirmation">Confirmer le mot de passe</label>
                <input type="password" id="confirmation" name="confirmation" required>
            </div>
            
            <button type="submit">S'inscrire</button>
        </form>
        
        <div class="login-link">
            Déjà un compte? <a href="connexion.php">Se connecter</a>
        </div>
    </div>
</body>
</html>