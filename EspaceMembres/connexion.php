<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');

if(isset($_POST['connexion'])) {
    if(!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = $_POST['mdp'];

        $req = $bdd->prepare('SELECT id, pseudo, mdp FROM users WHERE pseudo = ?');
        $req->execute([$pseudo]);
        $user = $req->fetch();

        if($user && password_verify($mdp, $user['mdp'])) {
            // Succès de l'authentification, initialisation de la session
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['id'] = $user['id'];

            // Définition du cookie pour le pseudo de l'utilisateur
            setcookie("pseudo", $user['pseudo'], time() + (86400 * 30), "/");
            header('location: ../index.php');
            exit;
        } else {
            // Identifiant ou mot de passe incorrect
            $error = "Identifiant ou mot de passe incorrect";
        }
    } else {
        // Tous les champs n'ont pas été remplis
        $error = "Veuillez compléter tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <?php if(isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <div>
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" id="pseudo" required>
        </div>
        <div>
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" autocomplete="off" required>
        </div>
        <div>
            <input type="submit" name="connexion" value="Se connecter">
        </div>
    </form>
</body>
</html>
