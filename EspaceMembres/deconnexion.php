<?php
session_start();
$_SESSION = array();
session_destroy();
header('location: connexion.php');
exit; // Assurez-vous de quitter le script après la redirection
?>
