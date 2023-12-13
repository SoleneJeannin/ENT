<?php 
include('connexion.php');
session_start();

if (isset($_POST['reservation']) && isset($_POST['conditions'])){
    //Récupération des infos du formulaire
    $date_debut = $_POST['debut'];
    $date_fin = $_POST['fin'];
    $materiel = $_POST['id_materiel'];

    //Récupération de l'utilisateur
    //Selectionne les attributs dans la bdd de l'utilisateur connecté 
    $stmt2 = $db->query("SELECT * FROM user WHERE user_login = '" . $_SESSION['login'] . "'");
    $result2=$stmt2->fetch(PDO::FETCH_ASSOC);
    $_SESSION['id_user'] = $result2['id_user'];

    //Envoit les données de la commande dans la base
    $stmt = $db->prepare("INSERT INTO reservation (res_date_debut, res_date_fin, ext_materiel, ext_utilisateur) VALUES (:date_debut, :date_fin, :materiel, :user)");
    $stmt->execute(array(
        ':date_debut' => $date_debut,
        ':date_fin' => $date_fin,
        ':materiel' => $materiel,
        ':user' => $_SESSION['id_user']
    ));

    //Retour à la page de réservation
    header("Location:reservation_materiel.php");
} else{
    header('Location:detail_materiel.php?err=pblm');
}
?>