<?php
session_start();
$error = ""; // Initialisation pour éviter l'erreur "Undefined variable"

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $csvFile = "utilisateurs.csv";

    if (($handle = fopen($csvFile, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($data[2] == $email && $data[3] == $password) {
                $_SESSION["user"] = [
                    "nom" => $data[0],
                    "prenom" => $data[1],
                    "email" => $data[2],
                    "role" => $data[4]  // On récupère le rôle (admin ou utilisateur)
                ];
                fclose($handle);

                // Rediriger en fonction du rôle
                if ($data[4] == "admin") {
                    header("Location: admin.php");
                } else {
                    header("Location: acceuil1.php");
                }
                exit();
            }
        }
        fclose($handle);
    }
    $error = "Email ou mot de passe incorrect.";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alabasta Trek - Connexion</title>
    <link rel="stylesheet" href="connexion.css">
    <script src="https://kit.fontawesome.com/a4f4cc5542.js" crossorigin="anonymous"></script>
</head>

<body>
    <section>
        <h1>Connexion</h1>
        <?php if (!empty($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
        <form action="connexion.php" method="post">
            <div class="inputbox">
                <input type="email" name="email" placeholder="Email" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="inputbox">
                <input type="password" name="password" placeholder="Mot de passe" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox"> Se souvenir de moi </label>
                <a href="#">Mot de passe oublié ?</a>
            </div>
            <button type="submit" class="login-btn">Se connecter</button>
        </form>
        <div class="register-link">
            <p>Pas de compte ? <a href="inscriptionV1.php">Inscription</a></p>
        </div>
    </section>
</body>
<footer>
    <a href="acceuil1.php" class="btn1">Retour à l'accueil</a>
</footer>

</html>