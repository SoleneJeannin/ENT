<?php 
include('connexion.php');
session_start();

//Récupération des infos
$id_salle=$_GET['id'];
$creneau_salle = $_GET['creneau'];


    //Récupération de l'utilisateur
    //Selectionne les attributs dans la bdd de l'utilisateur connecté 
    $stmt2 = $db->query("SELECT * FROM user WHERE user_login = '" . $_SESSION['login'] . "'");
    $result2=$stmt2->fetch(PDO::FETCH_ASSOC);
    $_SESSION['id_user'] = $result2['id_user'];

    //Envoit les données de la commande dans la base
    $stmt = $db->prepare("INSERT INTO reservation (res_date_debut, res_date_fin, ext_salle, ext_utilisateur, ext_creneau) VALUES (NOW(), NOW(), :salle, :user, :creneau)");
    $stmt->execute(array(
        ':salle' => $id_salle,
        ':user' => $_SESSION['id_user'],
        ':creneau' => $creneau_salle
    ));

    //Retour à la page de réservation
    header("Location:reservation_salle.php?etat=reserve&&id=$id_salle&&creneau=$creneau_salle");
?>