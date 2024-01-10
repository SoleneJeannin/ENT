<?php
include 'connexion.php';
session_start();

// Récupération des éléments du formulaire
$prenom = $_GET["prenom"];
$nom = $_GET["nom"];
$mdp = $_GET["mdp"];
$role = $_GET["role"];
$formation = $_GET["formation"];
$programme = $_GET["programme"];
$groupe = $_GET["groupe"];
$naissance = $_GET["naissance"];

// Création du login en fonction de leurs prénom et nom
$login = strtolower($prenom . "." . $nom);
echo $login;

// Vérification du login s'il existe dans la base de donnée
$requeteLoginExist = "SELECT * FROM user WHERE user_login=:login";
$stmtLoginExist = $db->prepare($requeteLoginExist);
$stmtLoginExist->bindParam(':login', $login, PDO::PARAM_STR);
$stmtLoginExist->execute();

// S'il renvoie quelque chose, alors le login existe
if($stmtLoginExist->rowCount()){
    header("Location:inscription.php?loginExistant");
}else{// Sinon INSERTION
    $requeteInsertion = "INSERT INTO user VALUES (NULL,:user_login,:user_nom,:user_prenom,:user_mdp,NULL,NULL,:ext_role,:user_programme,:user_groupe,0,0,0,0,NULL,:formation,0,:user_naissance)";
    $stmtInsertion = $db->prepare($requeteInsertion);
    $stmtInsertion->bindParam(':user_login',$login,PDO::PARAM_STR);
    $stmtInsertion->bindParam(':user_nom',$nom,PDO::PARAM_STR);
    $stmtInsertion->bindParam(':user_prenom',$prenom,PDO::PARAM_STR);
    $hash = password_hash($mdp, PASSWORD_DEFAULT);
    $stmtInsertion->bindParam(':user_mdp',$hash,PDO::PARAM_STR);
    $stmtInsertion->bindParam(':ext_role',$role,PDO::PARAM_INT);
    $stmtInsertion->bindParam(':user_programme',$programme,PDO::PARAM_STR);
    $stmtInsertion->bindParam(':user_groupe',$groupe,PDO::PARAM_STR);
    $stmtInsertion->bindParam(':formation',$formation,PDO::PARAM_STR);
    $stmtInsertion->bindParam(':user_naissance',$naissance,PDO::PARAM_STR);
    $stmtInsertion->execute();
    header("Location:inscription.php?ok");
}
?>