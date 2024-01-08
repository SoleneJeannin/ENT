<?php
// Connexion à la page connexion.php pour se connecter à la base de données "miniblog"
include 'connexion.php';
?>

<?php 
// Démarre la session
session_start();
// Détruit la session
session_destroy();

header("Location: login.php");
?>