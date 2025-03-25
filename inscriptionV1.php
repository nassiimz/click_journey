<?php
$csvFile = "utilisateurs.csv";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];
    $date_naissance = $_POST["date_naissance"];

    // Vérifier si les mots de passe correspondent
    if ($password !== $password_confirm) {
        $error = "Les mots de passe ne correspondent pas !";
    } else {
        // Hacher le mot de passe
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        // Vérifier si l'email existe déjà
        if (file_exists($csvFile)) {
            if (($handle = fopen($csvFile, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if ($data[2] === $email) {
                        fclose($handle);
                        $error = "Cet email est déjà utilisé !";
                        break;
                    }
                }
                fclose($handle);
            }
        }

        // Si pas d'erreur, on enregistre l'utilisateur
        if (!isset($error)) {
            $handle = fopen($csvFile, "a");
            if ($handle !== FALSE) {
                fputcsv($handle, [$nom, $prenom, $email, $password_hashed, $date_naissance]);
                fclose($handle);
                header("Location: connexion.php"); // Redirige vers la connexion
                exit();
            } else {
                $error = "Erreur lors de l'inscription.";
            }
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
    <link rel="stylesheet" href="inscriptionv1.css">
</head>

<body>

    <div class="wrapper">
        <form action="inscriptionV1.php" method="post">
            <h1>Enregistrement</h1>

            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

            <div class="inputbox">
                <div class="inputfield">
                    <input type="text" name="nom" placeholder="Nom complet" required>
                </div>
                <div class="inputfield">
                    <input type="text" name="prenom" placeholder="Prénom" required>
                </div>
            </div>

            <div class="inputbox">
                <div class="inputfield">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="inputfield">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </div>
            </div>

            <div class="inputbox">
                <div class="inputfield">
                    <input type="password" name="password_confirm" placeholder="Confirmez le mot de passe" required>
                </div>
                <div class="inputfield">
                    <input type="date" name="date_naissance" required>
                </div>
            </div>

            <label>
                <input type="checkbox" name="conditions" required>
                Je déclare que les informations renseignées sont correctes.
            </label>

            <button type="submit" class="btn"> Enregistrer </button>
        </form>
    </div>

</body>

</html>