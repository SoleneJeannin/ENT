<?php
include 'connexion.php';
session_start();

$idProjet = $_POST["idProjet"];

$idMatiere = $_POST["idMatiere"];


if (isset($_SESSION["login"])) {
    if (isset($idProjet)) {
        $requeteSupprimerProjet = "DELETE FROM eval_projet WHERE id_eval_projet=:idProjet";
        $stmtSupprimerProjet = $db->prepare($requeteSupprimerProjet);
        $stmtSupprimerProjet->bindParam(':idProjet', $idProjet, PDO::PARAM_INT);
        $stmtSupprimerProjet->execute();
        header("Location: teacher_matier.php?id_matiere=$idMatiere&confirmationProj=ok");
    } else {
        header("Location: teacher_matier.php?id_matiere=$idMatiere&confirmationProj=non");
    }
}




?>