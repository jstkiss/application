<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');

if (isset($_POST['envoie'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); 
        $token = uniqid();

// Insertion de l'utilisateur dans la base de données avec le jeton
$insertUser = $bdd->prepare('INSERT INTO users(pseudo, mdp, token) VALUES(?, ?, ?)');
$insertUser->execute([$pseudo, $mdp, $token]);

// Stockage du jeton dans un cookie
setcookie('token', $token, time() + (86400 * 30), "/");
header('location: ../index.html');
    } else {
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
    <form action="" method="POST" class="justify-center">
    <input type="text" name="pseudo" autocomplete="off">
    <br>
    <input type="password" name="mdp" id="" autocomplete="off">
    <br>
    <input type="submit" name="envoie">
    </form>
</body>
</html>