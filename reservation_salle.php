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

        <div>
        <!--BARRE DE RECHERCHE-->
        </div>

        <div>
            <?php
            $stmt=$db->query("SELECT * FROM salle");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){ 
            //Affiche toutes les salles + quand on clique sur une des salles ça envoie son numéro en GET
            ?>
                <a href="reservation_salle?id=<?= $row['id_salle']?>">
                    <!--Numéro de la salle-->
                    <?= $row['id_salle']?>
                </a>             
            <?php
            }
            //Si on a cliqué sur une salle : 
            if(isset($_GET['id'])){ 
                $num_salle = $_GET['id'];
                ?>
                <div>
                    <h2>Salle <?= $num_salle ?></h2> <?php 
                     $stmt_salle=$db->query("SELECT * FROM salle WHERE id_salle = $num_salle");
                    $result_salle=$stmt_salle->fetch(PDO::FETCH_ASSOC);
                    //Est ce que la salle est occupée ?
                    if($result_salle['statut'] == '1'){ // Si oui : 
                        echo 'Salle non disponible';
                    } else{ // Si non : ?>
                        <p>Salle disponible de ? à ?</p>
                        <!--Faire juste 4 crénaux possibles (8-10 10-12 14-16 16-18)
                    Comment on peut faire ? 
                    * le statut sert plus à rien => occupé pour une durée seulement
                    * ajouter créneau dans réervation ?
                    * il faudrait qu'après et avant ce créaneau le chiffre repasse à 0 ? POSSIBLE ???
                    
                    -->
                        <!--Formulaire de réservation-->
                        <form action="traite_reservation.php?id=<?=$result['id_materiel']?>" method="POST">
                            <input type="hidden" name="id_materiel" value="<?= $result['id_materiel']?>">
                            <p>Date de réservation</p>

                            <label for="debut">début : </label>
                            <input type="date" id="debut" name="debut">
                            <br>
                            <label for="fin">fin : </label>
                            <input type="date" id="fin" name="fin">
                            <br><br>
                            <input type="radio" id="conditions" name="conditions" value="conditions"/>
                            <label for="conditions">En cochant cette case, j’accepte <a href="./document/regles_utilisation">les règles d’utilisation</a></label>
                            <br><br>
                            <input type="submit" name="reservation" value="Réserver">
                        </form>
                    <?php
                    }
                    ?>                    
                </div>
            <?php
            }
            ?>
        </div>
    </main>


</body>

</html>