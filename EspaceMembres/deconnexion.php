<?php
session_start();

// Supprimer toutes les variables de session
$_SESSION = array();

// Détruire la session
session_destroy();

// Supprimer les cookies de pseudo et de token
setcookie('pseudo', '', time() - 3600, '/');
setcookie('token', '', time() - 3600, '/');

// Rediriger l'utilisateur vers la page d'accueil
header('location: ../index.php');
exit;
?>
