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
    <title>Réservation Salle</title>

    
</head>

<body>

    <main>
    

        <?php

        include('nav.php');
        include('connexion.php');
        session_start();
        
        ?>
        <h1>Réservez votre salle</h1>

        <div>
        <!--BARRE DE RECHERCHE-->
        </div>

        <div>
            <?php
            $stmt_cam=$db->query("SELECT * FROM salle");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){ ?>
                <!--Nom de la salle-->
                <h3><?= $row['salle_nom']?></h3>               
            <?php
            }
            ?>
        </div>
    </main>


</body>

</html>