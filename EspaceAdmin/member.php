<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=test', 'root' , '');
if(!$_SESSION['mdp']){
    header('location: connexion.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="link_container">
            <a class="link" href="">ggggg</a>
        </div>
        <table>
            <thead>
                <th>Nom</th>
                <th>Modifier</th>
                <th>Bannir</th>
            </thead>
            <tbody>
                <?php
                $recupUser = $bdd->query('SELECT * FROM users');
                while($user = $recupUser->fetch()){
                ?>
                <tr> <!-- Déplacer la balise <tr> à l'intérieur de la boucle -->
                    <td><?= $user['pseudo']; ?></td>
                    <td class="image"><a href=""> <img src="../images/write.png" alt="m"></a></td>
                    <td class="image"><a href="deleteUser.php?id=<?= $user['id']; ?>"> <img src="../images/remove.png" alt="r"></a></td>

                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>