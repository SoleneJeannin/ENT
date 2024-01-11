<?php 
include 'connexion.php';
session_start();
$idUser = $_POST["idUser"];

if(isset($_SESSION["login"]) && $_SESSION["role"] === 3){
    if (isset($idUser)){
        $requeteSupprimerUtilisateur = "DELETE FROM user WHERE id_user=:idUser";
        $stmtSupprimerUtilisateur = $db->prepare($requeteSupprimerUtilisateur);
        $stmtSupprimerUtilisateur->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmtSupprimerUtilisateur->execute();
        header("Location: admin_page.php?suppOk");
    }
    else{
        header("Location: admin_page.php?suppNon");
    }
}
?>