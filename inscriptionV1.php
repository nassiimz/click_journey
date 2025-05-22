<?php
session_start();

// Redirection si déjà connecté
if (isset($_SESSION['user'])) {
    header('Location: profil.php');
    exit;
}

$error = '';
$success = '';
$csvFile = 'utilisateurs.csv';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validation
    if (empty($nom) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = 'Tous les champs sont obligatoires';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email invalide';
    } elseif ($password !== $confirm_password) {
        $error = 'Les mots de passe ne correspondent pas';
    } elseif (strlen($password) < 8) {
        $error = 'Le mot de passe doit faire au moins 8 caractères';
    } else {
        // Vérifier si l'email existe déjà
        if (file_exists($csvFile)) {
            $file = fopen($csvFile, 'r');
            while (($data = fgetcsv($file)) !== FALSE) {
                if (isset($data[1]) && $data[1] === $email) {
                    $error = 'Cet email est déjà utilisé';
                    break;
                }
            }
            fclose($file);
        }

        if (empty($error)) {
            // Hachage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Créer le fichier s'il n'existe pas
            if (!file_exists($csvFile)) {
                file_put_contents($csvFile, "nom,email,mot_de_passe\n");
            }

            // Ajouter le nouvel utilisateur
            $file = fopen($csvFile, 'a');
            fputcsv($file, [$nom, $email, $hashed_password]);
            fclose($file);

            $success = 'Inscription réussie ! Redirection...';
            header('Refresh: 2; URL=connexion.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inscriptionv1.css">
    <title>Inscription | Rajjel Desert</title>
    <style>
        :root {
            --primary: #E67E22;
            --secondary: #D35400;
            --dark: #2C3E50;
            --light: #ECF0F1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo h1 {
            color: var(--dark);
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .logo p {
            color: var(--primary);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark);
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .password-strength {
            height: 5px;
            background: #eee;
            border-radius: 3px;
            margin-top: 5px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s;
        }

        .btn {
            width: 100%;
            padding: 0.8rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover {
            background: var(--secondary);
        }

        .error {
            color: #e74c3c;
            text-align: center;
            margin: 1rem 0;
            padding: 0.5rem;
            background: #ffebee;
            border-radius: 5px;
        }

        .success {
            color: #27ae60;
            text-align: center;
            margin: 1rem 0;
            padding: 0.5rem;
            background: #e8f5e9;
            border-radius: 5px;
        }

        .links {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }

        .links a {
            color: var(--primary);
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .back-home {
            text-align: center;
            margin-top: 1rem;
        }

        .btn-back {
            display: inline-block;
            padding: 0.5rem 1rem;
            color: var(--primary);
            text-decoration: none;
            border: 1px solid var(--primary);
            border-radius: 5px;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background-color: var(--primary);
            color: white;
        }
    </style>
</head>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nomInput = document.getElementById('nom');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const form = document.querySelector('form');

        // Limites de caractères
        const limits = {
            nom: 30,
            email: 50,
            password: 25
        };

        // Créer les compteurs
        function createCounter(input, max) {
            const counter = document.createElement('div');
            counter.className = 'char-counter';
            counter.style.fontSize = '0.8rem';
            counter.style.color = '#666';
            counter.style.marginTop = '5px';
            counter.style.textAlign = 'right';
            counter.textContent = `0/${max}`;
            input.parentNode.appendChild(counter);

            input.addEventListener('input', function() {
                const currentLength = this.value.length;
                counter.textContent = `${currentLength}/${max}`;

                if (currentLength > max) {
                    counter.style.color = 'red';
                    this.value = this.value.substring(0, max);
                } else {
                    counter.style.color = currentLength === max ? 'orange' : '#666';
                }
            });
        }

        // Initialiser les compteurs
        createCounter(nomInput, limits.nom);
        createCounter(emailInput, limits.email);
        createCounter(passwordInput, limits.password);

        // Validation avant soumission
        form.addEventListener('submit', function(e) {
            let isValid = true;

            if (nomInput.value.length === 0) {
                alert('Veuillez entrer votre nom complet');
                isValid = false;
            } else if (nomInput.value.length > limits.nom) {
                alert(`Le nom ne peut pas dépasser ${limits.nom} caractères`);
                isValid = false;
            }

            if (emailInput.value.length === 0) {
                alert('Veuillez entrer votre email');
                isValid = false;
            } else if (emailInput.value.length > limits.email) {
                alert(`L'email ne peut pas dépasser ${limits.email} caractères`);
                isValid = false;
            }

            if (passwordInput.value.length === 0) {
                alert('Veuillez entrer un mot de passe');
                isValid = false;
            } else if (passwordInput.value.length > limits.password) {
                alert(`Le mot de passe ne peut pas dépasser ${limits.password} caractères`);
                isValid = false;
            } else if (passwordInput.value.length < 8) {
                alert('Le mot de passe doit faire au moins 8 caractères');
                isValid = false;
            }

            if (passwordInput.value !== confirmPasswordInput.value) {
                alert('Les mots de passe ne correspondent pas');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>

<body>
    <script src="cacher-mdp.js"></script>
    <div class="register-container">
        <div class="logo">
            <h1>Rajjel Desert</h1>
            <p>Créez votre compte</p>
        </div>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php elseif ($success): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="nom">Nom complet</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe (8 caractères minimum)</label>
                <input type="password" id="password" name="password" required minlength="8" oninput="checkPasswordStrength(this.value)">
                <div class="password-strength">
                    <div class="strength-bar" id="strengthBar"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmez le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" class="btn">S'inscrire</button>
        </form>

        <div class="links">
            Déjà un compte ? <a href="connexion.php">Se connecter</a>
        </div>
        <div class="back-home">
            <a href="acceuil1.php" class="btn-back">← Retour à l'accueil</a>
        </div>


    </div>

    <script>
        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('strengthBar');
            let strength = 0;

            if (password.length > 0) strength += 20;
            if (password.length >= 8) strength += 30;
            if (/[A-Z]/.test(password)) strength += 20;
            if (/[0-9]/.test(password)) strength += 20;
            if (/[^A-Za-z0-9]/.test(password)) strength += 10;

            strengthBar.style.width = strength + '%';

            if (strength < 50) {
                strengthBar.style.backgroundColor = '#e74c3c';
            } else if (strength < 80) {
                strengthBar.style.backgroundColor = '#f39c12';
            } else {
                strengthBar.style.backgroundColor = '#27ae60';
            }
        }
    </script>
</body>

</html>