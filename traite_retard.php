<?php
session_start();

include('connexion.php');

if(isset($_POST['etudiant'])){
    //Récupération de l'id de l'étudiant
    $id_user = $_POST['etudiant'];

    $retard = $_POST['retard'];

    //Remlpacement dans la base (ajouter les nouveaux retards aux anciens, ne les remplace pas juste)
    $stmt = $db->prepare("UPDATE user SET user_retard = user_retard + :nouveau_retard WHERE id_user = :id_user");

    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $stmt->bindParam(':nouveau_retard', $retard, PDO::PARAM_INT);
    $stmt->execute();


    // Récupération des données du formulaire
    $id_user = $_POST['etudiant'];
    $retard = $_POST['retard'];
    $duree = $_POST['duree'];
    $cours = $_POST['cours'];
    $justif = isset($_POST['justif']) ? $_POST['justif'] : '';

    // Insertion des données dans la table "absence"
    $stmt_abs = $db->prepare("INSERT INTO absence (id_abs, ext_etudiant, ext_cours, abs_duree, abs_justificatif) VALUES (NULL, :id_user, :cours, :duree, :justif)");
    $stmt_abs->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $stmt_abs->bindParam(':cours', $cours, PDO::PARAM_INT);
    $stmt_abs->bindParam(':duree', $duree, PDO::PARAM_INT);
    $stmt_abs->bindParam(':justif', $justif, PDO::PARAM_STR);
    $stmt_abs->execute();


    header("Location:retard.php?etat=misajour");
}


?>