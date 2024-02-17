<?php
session_start();
if(!$_SESSION['mdp']){
    header('location: connexion.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <a href="member.php">Afficher tous les membre</a>
    <br>
    <a href="publier-article.php">Publier un nouvel article</a>
</body>
</html>