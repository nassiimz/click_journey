<?php
session_start();

// Chemin du fichier CSV
$csv_file = 'utilisateurs.csv';

// Récupérer la page de redirection depuis l'URL
$redirect = $_GET['redirect'] ?? 'profil.php';

// Traitement du formulaire
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    if (empty($email) || empty($mot_de_passe)) {
        $message = 'Tous les champs sont obligatoires.';
    } else {
        // Vérifier les identifiants
        if (file_exists($csv_file)) {
            $file = fopen($csv_file, 'r');
            $trouve = false;
            
            // Passer la première ligne (en-têtes)
            fgetcsv($file);
            
            while (($data = fgetcsv($file)) !== FALSE) {
                if ($data[1] === $email && password_verify($mot_de_passe, $data[2])) {
                    $_SESSION['user'] = [  // Changé de 'utilisateur' à 'user' pour cohérence
                        'nom' => $data[0],
                        'email' => $data[1]
                    ];
                    $trouve = true;
                    break;
                }
            }
            fclose($file);
            
            if ($trouve) {
                // Redirection vers la page demandée ou profil.php par défaut
                header("Location: " . $redirect);
                exit();
            } else {
                $message = 'Email ou mot de passe incorrect.';
            }
        } else {
            $message = 'Aucun utilisateur enregistré.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
        .error {
            background-color: #f2dede;
            color: #a94442;
        }
        .register-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        
        <?php if ($message): ?>
            <div class="message error">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        
        <form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>
            
            <button type="submit">Se connecter</button>
        </form>
        
        <div class="register-link">
            Pas encore de compte? <a href="inscriptionV1.php">S'inscrire</a>
        </div>
    </div>
</body>
</html>