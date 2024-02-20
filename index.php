<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=test', 'root' , '');

// Vérifier si l'utilisateur est connecté
if(isset($_SESSION['pseudo']) && isset($_COOKIE['token'])) {
    $pseudo = $_SESSION['pseudo'];
    $token = $_COOKIE['token'];

    $req = $bdd->prepare("SELECT * FROM users WHERE pseudo = :pseudo AND token = :token");
    $req->execute(array('pseudo' => $pseudo, 'token' => $token));

    $rep = $req->fetch();

    if($rep !== false) {
        echo "Vous êtes bien connecté en tant que ".$rep['pseudo']." !";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./styles.css" />
    <title>Document</title>
</head>
<body>
    <h1>Bonjour <?php echo isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : ''; ?></h1>
    <a href="./EspaceMembres/deconnexion.php">
        <button>Se déconnecter</button>
    </a>
    <?php if(!isset($_SESSION['pseudo'])): ?>
    <nav>
      <ul class="flex items-center text-2xl">
        <li class="pl-4">
          <a href="./EspaceMembres/connexion.php">connexion</a>
        </li>
        <li class="pl-4">
          <a href="./EspaceMembres/inscription.php">inscription</a>
        </li>
      </ul>
    </nav>
    <?php endif; ?>
</body>
</html>
