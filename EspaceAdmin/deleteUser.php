<?php
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root' , '');
    if(isset($_GET['id']) AND !empty($_GET['id'])){
        $getid = $_GET['id'];
        $recupUser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
        $recupUser->execute(array($getid));
        if($recupUser->rowCount() > 0){

            $deleteUser = $bdd->prepare( "DELETE FROM users WHERE id = ?" );
            $deleteUser->execute([$getid]);

            header('location: member.php');

        }else{
            echo "Aucun membre n'a été trouvé";
        } 
    }else{
        echo "L'identifiant n'a pas été récupéré";
    }
?>