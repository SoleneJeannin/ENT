<?php
include 'connexion.php';
session_start();

$idExam = $_POST["idExam"];

$idMatiere = $_POST["idMatiere"];


if (isset($_SESSION["login"])) {
    if (isset($idExam)) {
        $requeteSupprimerExam = "DELETE FROM eval_exam WHERE id_eval_exam=:idExam";
        $stmtSupprimerExam = $db->prepare($requeteSupprimerExam);
        $stmtSupprimerExam->bindParam(':idExam', $idExam, PDO::PARAM_INT);
        $stmtSupprimerExam->execute();
        header("Location: teacher_matier.php?id_matiere=$idMatiere&confirmation=ok");
    } else {
        header("Location: teacher_matier.php?id_matiere=$idMatiere&confirmation=non");
    }
}




?>