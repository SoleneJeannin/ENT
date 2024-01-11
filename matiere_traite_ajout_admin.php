<?php
include 'connexion.php';
session_start();
// récupération des données du formulaire
$programme = $_GET["programme"];
$MatiereTitre = $_GET["matiere-titre"];
$description = $_GET["description"];
$couleur = $_GET["couleur"];
$professeur = $_GET["professeur"];
$coef = $_GET["coef"];
// Je vérifie que la matière n'a pas encore été inséré
$requeteMatiereExist = "SELECT nom_matiere FROM matiere WHERE nom_matiere=:matiere";
$stmtMatiereExist = $db->prepare($requeteMatiereExist);
$stmtMatiereExist->bindParam(':matiere', $MatiereTitre, PDO::PARAM_STR);
$stmtMatiereExist->execute();

// Condition si existe ou non
if($stmtMatiereExist->rowCount()){
    header("Location:matiere_ajout_admin.php?titreExistant");
}else{
    $requeteInsertMatiere = "INSERT INTO matiere VALUES (NULL,:programme,:description,:couleur,:nom_matiere,:ext_prof,:coef_matiere,NULL)";
    $stmtInsertMatiere = $db->prepare($requeteInsertMatiere);
    $stmtInsertMatiere->bindParam(':programme',$programme,PDO::PARAM_STR);
    $stmtInsertMatiere->bindParam(':description',$description,PDO::PARAM_STR);
    $stmtInsertMatiere->bindParam(':couleur',$couleur,PDO::PARAM_STR);
    $stmtInsertMatiere->bindParam(':nom_matiere',$MatiereTitre,PDO::PARAM_STR);
    $stmtInsertMatiere->bindParam(':ext_prof',$professeur,PDO::PARAM_INT);
    $stmtInsertMatiere->bindParam(':coef_matiere',$coef,PDO::PARAM_INT);
    $stmtInsertMatiere->execute();
    header("Location:matiere_ajout_admin.php?ok");
}

?>