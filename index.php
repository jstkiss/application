<?php
session_start();
if(!isset($_SESSION['mdp']) || empty($_SESSION['mdp'])) {
    header('location: ./EspaceMembres/connexion.php');
    exit; // Assurez-vous de quitter le script après la redirection
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bonjour  <?php echo $_SESSION['pseudo'] ?></h1>
    <a href="./EspaceMembres/deconnexion.php">
        <button>Se déconnecter</button>
    </a>
</body>
</html>