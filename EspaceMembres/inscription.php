<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=test', 'root' , '');
if(isset($_POST['envoie'])) {
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = sha1($_POST['mdp']);
        $insertUser = $bdd->prepare('INSERT INTO  users(pseudo, mdp)VALUES(?, ?)');
        $insertUser->execute([$pseudo, $mdp]);

        $recupUser = $bdd->prepare("SELECT * FROM users WHERE pseudo = ?");
        $recupUser->execute([$pseudo]);
        
    if ($recupUser->rowCount() > 0) {
        // L'utilisateur existe dans la base de données
        $userData = $recupUser->fetch(); // Récupère les données de l'utilisateur
    
        // Stocke les données de l'utilisateur dans la session
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['mdp'] = $mdp;
        $_SESSION['id'] = $userData['id'];
        header('location: ../index.html');
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
    <form action="" method="post" class="justify-center">
    <input type="text" name="pseudo" autocomplete="off">
    <br>
    <input type="password" name="mdp" id="" autocomplete="off">
    <br>
    <input type="submit" name="envoie">
    </form>
</body>
</html>