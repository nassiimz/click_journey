<?php
session_start();

// Vérification si déjà connecté
if (isset($_SESSION['user'])) {
    header('Location: profil.php');
    exit;
}

$error = '';
$csvFile = 'utilisateurs.csv';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = 'Email et mot de passe requis';
    } else {
        if (file_exists($csvFile)) {
            $file = fopen($csvFile, 'r');
            $loggedIn = false;

            // Passer l'en-tête
            fgetcsv($file);

            while (($data = fgetcsv($file)) !== FALSE) {
                if ($data[1] === $email && password_verify($password, $data[2])) {
                    $_SESSION['user'] = [
                        'nom' => $data[0],
                        'email' => $data[1],
                        'role' => in_array($data[1], ['admin@example.com', 'nassim@example.com']) ? 'admin' : 'user'
                    ];
                    $loggedIn = true;
                    break;
                }
            }
            fclose($file);

            if ($loggedIn) {
                header('Location: profil.php');
                exit;
            } else {
                $error = 'Identifiants incorrects';
            }
        } else {
            $error = 'Aucun utilisateur enregistré';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Connexion | Rajjel Desert</title>
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
            background: url('https://dailygeekshow.com/wp-content/uploads/2022/11/une-sahara-poussiere-1024x576.jpg') no-repeat center center fixed;
            background-size: cover;
            backdrop-filter: blur(10px);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
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
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const form = document.querySelector('form');

        // Limites de caractères
        const limits = {
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
        createCounter(emailInput, limits.email);
        createCounter(passwordInput, limits.password);

        // Validation avant soumission
        form.addEventListener('submit', function(e) {
            let isValid = true;

            if (emailInput.value.length === 0) {
                alert('Veuillez entrer votre email');
                isValid = false;
            } else if (emailInput.value.length > limits.email) {
                alert(`L'email ne peut pas dépasser ${limits.email} caractères`);
                isValid = false;
            }

            if (passwordInput.value.length === 0) {
                alert('Veuillez entrer votre mot de passe');
                isValid = false;
            } else if (passwordInput.value.length > limits.password) {
                alert(`Le mot de passe ne peut pas dépasser ${limits.password} caractères`);
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
    <div class="login-container">
        <div class="logo">
            <h1>Rajjel Desert</h1>
            <p>Connectez-vous à votre espace</p>
        </div>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn">Se connecter</button>
        </form>
        <div class="links">
            Pas encore de compte ? <a href="inscriptionV1.php">S'inscrire</a><br>
            <a href="acceuil1.php" class="btn-back">← Retour à l'accueil</a>
        </div>

    </div>
</body>

</html>