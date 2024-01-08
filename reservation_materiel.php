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
        <link rel="stylesheet" href="reservation_materiel.css">
    <title>Réservation - materiel</title>

    
</head>

<body>
    <script>
        //Apparition de la popup
        function popup() {
            document.getElementsByClassName("popup")[0].style.top = "140px";
        }
    </script>

    <main>
    

        <?php
        session_start();
        include('nav.php');
        include('connexion.php');
        
        //Si on vient de reserver une salle
        if(isset($_GET['etat'])){ ?>
            <div class="popup">
                <p>La réservation a fonctionné !</p>
            </div>
            
            <?php 
            //Appel la fonction js qui fait apparaitre la popup
            echo "<script> popup(); </script>"; 
        
        }
        //Sinon la popup ne s'affiche juste pas
        ?>


        <h1>Réservez votre matériel</h1>
        <br>
        <!--Afficher les materiaux-->
        <h2>Caméra : </h2>

        <div class="bloc_materiel">
        <?php
        $stmt_cam=$db->query("SELECT * FROM materiel WHERE type = 'camera' ");
        $result_cam=$stmt_cam->fetchAll(PDO::FETCH_ASSOC);
        foreach($result_cam as $cam){ ?>
            <!--Pour que ce soit cliquable-->
            <div class="bloc_lien_img">
            <a class="materiel" href="detail_materiel.php?id=<?= $cam["id_materiel"]; ?>">
                <!--Image-->
                <?= $cam['image']?>
                <!--Nom du materiel-->
                <h3><?= $cam['materiel_titre']?></h3>
            </a>
            </div>
            
        <?php
        }
        ?>
</div>
<br> <br> <br>
        <h2>Son : </h2>

<div class="bloc_materiel">
        <?php
        $stmt_son=$db->query("SELECT * FROM materiel WHERE type = 'son' ");
        $result_son=$stmt_son->fetchAll(PDO::FETCH_ASSOC);
        foreach($result_son as $son){ ?>
            <!--Pour que ce soit cliquable-->
            <a class="materiel" href="detail_materiel.php?id=<?= $son["id_materiel"]; ?>">
                <!--Image-->
                <?= $son['image']?>
                <!--Nom du materiel-->
                <h3><?= $son['materiel_titre']?></h3>
            </a>
        <?php
        }
        ?>
</div>
<br> <br> <br>
        <h2>Lumière : </h2>

<div class="bloc_materiel">
        <?php
        $stmt_lum=$db->query("SELECT * FROM materiel WHERE type = 'lumiere' ");
        $result_lum=$stmt_lum->fetchAll(PDO::FETCH_ASSOC);
        foreach($result_lum as $lum){ ?>
            <a class="materiel" href="detail_materiel.php?id=<?= $lum["id_materiel"]; ?>">
                <!--Image-->
                <?= $lum['image']?>
                <!--Nom du materiel-->
                <h3><?= $lum['materiel_titre']?></h3>
            </a>
        <?php
        }
        ?>
</div>
    </main>


</body>

</html>