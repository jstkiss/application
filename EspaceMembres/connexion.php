<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=test', 'root' , '');

if(isset($_POST['envoie'])) {
    if(!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = sha1($_POST['mdp']); // À des fins d'apprentissage uniquement, préférez bcrypt ou Argon2 pour un usage réel.

        $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
        $recupUser->execute([$pseudo, $mdp]);

        if($recupUser->rowCount() > 0){
            // L'utilisateur existe dans la base de données
            $userData = $recupUser->fetch();

            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['id'] = $userData['id'];
            
            // Définition des cookies
            setcookie('pseudo', $pseudo, time() + (86400 * 30), "/"); // Valide pendant 30 jours
            setcookie('mdp', $mdp, time() + (86400 * 30), "/"); // Valide pendant 30 jours
            echo "Vous êtes bien connecté avec vos accès : ".$_COOKIE['pseudo'].' - '.$_COOKIE['mdp'];
            
            header('location: ../index.php'); // Redirection après une authentification réussie
            exit; // Arrête l'exécution du script après la redirection
        }else {
            // Évitez de donner des informations spécifiques sur l'échec de l'authentification
            echo "Identifiant ou mot de passe incorrect.";
        }

    }else {
        echo "Veuillez compléter tous les champs";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
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
        <input type="submit" name="envoie" value="Se connecter">
    </div>
</form>

</html>