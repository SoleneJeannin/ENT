<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&family=Lusitana:wght@400;700&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="style_de_base.css">
        <link rel="stylesheet" href="reservation_salle.css">
    <title>Réservation Salle</title>

    
</head>

<body>

    <main>
    

        <?php
        session_start();
        include('nav.php');
        include('connexion.php');
        ?>
        <h1>Réservez votre salle</h1>
        <div class="sous_titre">Cliquez sur l'heure souhaitée située en dessous de la bonne salle</div>
        <br>

         <!--BARRE DE RECHERCHE-->
        <div class="bloc_recherche">
            <input type="search" placeholder="recherche...">
            <img class="img_loupe" src="./img/salle/loupe.png" alt="">
        </div>

    <br>

        <div class="des_salles">
            <?php
            $stmt=$db->query("SELECT * FROM salle");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){ 
            //Affiche toutes les salles + quand on clique sur une des salles ça envoie son numéro en GET
            $num_salle = $row['id_salle'];
            ?>
                <div class="une_salle">
                    <!--Numéro de la salle-->
                    <?= $num_salle?>
                    <?php
                    // Sélectionne les créneaux non réservés pour la salle spécifiée
                    $stmt_creneau = $db->prepare('SELECT * FROM creneau WHERE id_creneau NOT IN (SELECT ext_creneau FROM reservation WHERE ext_salle = :num_salle AND DATE(res_date_debut) = CURDATE())');
                    $stmt_creneau->bindParam(':num_salle', $num_salle, PDO::PARAM_INT);
                    $stmt_creneau->execute();

                    $result_creneau = $stmt_creneau->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result_creneau as $row){ ?>
                        <a href="traite_reservation_salle?id=<?= $num_salle; ?>&&creneau=<?= $row["id_creneau"]; ?>"><?= $row["horaire"]; ?></a>
                    <?php } ?>
                    
                    </div>             
                    <?php
                    }?>                    
                </div>
        </div>
    </main>


</body>

</html>