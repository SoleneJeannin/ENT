<?php
session_start();

include('connexion.php');


if (isset($_POST['nvo_titre']) && isset($_POST['nvo_texte'])) {
    // Insertion de la nouvelle actualité 

    //Informations dans actualite
    $requete = "INSERT INTO actualite (actu_text, actu_date, actu_titre, actu_img, actu_accroche) VALUES (:texte, NOW(), :titre, NULL, :accroche)";

    $stmt = $db->prepare($requete);
    $stmt->bindParam(':texte', $_POST["nvo_texte"], PDO::PARAM_STR);
    $stmt->bindParam(':titre', $_POST["nvo_titre"], PDO::PARAM_STR);
    $stmt->bindParam(':accroche', $_POST["nvo_accroche"], PDO::PARAM_STR);

    //Informations dans la table intermédiaire actu_actegorie

    //Récupération de l'id le plus grand pour déduire l'id du nouvel article
    $stmt_grand_id = $db->query("SELECT id_actu FROM actualite ORDER BY id_actu DESC");
    $result_grand_id = $stmt_grand_id->fetch(PDO::FETCH_ASSOC);
    $id_grand = $result_grand_id['id_actu'];
    //Déduction du nouvel ID de l'article
    $nvl_id = $id_grand +1;

    //Entrée des données dans la table intermédiaire
    if(isset($_POST['categ'])){
        foreach($_POST['categ'] as $categorie){
            $requete2 = "INSERT INTO categorie_actu (ext_categorie, ext_actu) VALUES (:categ, :actu) ";
            $stmt2 = $db->prepare($requete2);
            $stmt2->bindParam(':categ', $categorie, PDO::PARAM_STR);
            $stmt2->bindParam(':actu', $nvl_id, PDO::PARAM_STR);
            $stmt2->execute();
        }
    }

    $stmt->execute();
    
    header("Location:actualites.php?etat=cree");
}
?>