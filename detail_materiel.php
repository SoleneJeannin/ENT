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
        <link rel="stylesheet" href="style_de base.css">
    <title>Réservation - matériel</title>

    
</head>

<body>

    <main>
    

        <?php

        include('nav.php');
        include('connexion.php');
        session_start();
        
        ?>
        
        <?php
        $materiel_res = $_GET["id"];
        $stmt=$db->query("SELECT * FROM materiel WHERE id_materiel= '$materiel_res'");
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <!--Materiel selectionné à la page "reservation_materiel-->
        <div>
            <h2><?= $result['materiel_titre']?></h2>
            <div>
                <!--Image-->
                <?= $result['image']?>
                <!--Description-->
                <?= $result['description']?>
            </div>
        </div>

        <!--Formulaire de réservation-->
        <form action="traite_reservation.php" method="POST">
            <input type="hidden" name="id_materiel" value="<?= $result['id_materiel']?>">
            <p>Date de réservation</p>

            <label for="debut">début : </label>
            <input type="date" id="debut" name="debut">
            <br>
            <label for="fin">fin : </label>
            <input type="date" id="fin" name="fin">
            <br><br>
            <input type="submit" name="reservation" value="Réserver">
        </form>

        <!--Affiche le bouon de téléchargement de la notice (si il y en a une)-->
        <?php if($result['notice'] != ''){ ?>
        <a href="./document/notices/<?= $result['notice']?>">Télécharger la notice</a>
        <?php }else{
            echo '';
        }?>

    </main>


</body>

</html>