<!DOCTYPE html>
<html lang="fr">

<?php
session_start();
include('connexion.php');
?>

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
    <title>Réservation - matériel</title>

    
</head>

<body>


    <script>
        //Apparition de la popup
        function popup() {
            document.getElementsByClassName("popup")[0].style.top = "140px";
        
            // Pour que la popup reste pas longtemps
            setTimeout(function() {
                document.getElementsByClassName("popup")[0].style.top = "-80px";
            }, 3000); // 3000 millisecondes = 3 secondes
        }
    </script>

    <main>
    

        <?php  
        include('nav.php');
        if(isset($_SESSION['login'])){
            $user = $_SESSION['login'];

            $stmt_user=$db->query("SELECT * FROM user WHERE user_login = '$user' ");
            $result_user=$stmt_user->fetch(PDO::FETCH_ASSOC);

            $num_role = $result_user['ext_role'];

            $stmt_role=$db->query("SELECT * FROM role WHERE id_role = $num_role ");
            $result_role=$stmt_role->fetch(PDO::FETCH_ASSOC);

            $role = $result_role['role_titre'];
        }
        
        
        ?>

        <?php

        //Si on vient de reserver une salle
        if(isset($_GET['etat'])){ 
            if($_GET['etat']=='reserve') {?>

            <div class="popup">
                <p>La réservation a fonctionné !</p>
            </div>
            
            <?php 
            //Appel la fonction js qui fait apparaitre la popup
            echo "<script> popup(); </script>"; 

            } elseif($_GET['etat']=='misajour') { ?>
            <div class="popup">
                    <p>Le stock a été mis à jour !</p>
                </div>
                
                <?php 
                //Appel la fonction js qui fait apparaitre la popup
                echo "<script> popup(); </script>"; 

            }
        }

        if($role == 'Étudiant'){
            ?>
<!--POUR LES ÉLÈVES-->

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
        <?php
        }?>

        

    <!--POUR LES ADMINS--> 
    <?php
    if($role == 'Admin'){  ?> 

        <h1>Mise à jour du stock du matériel</h1>
        <form action="traite_stock.php" method="POST">
        <?php
            $stmt_stock=$db->query("SELECT * FROM materiel");
            $result_stock=$stmt_stock->fetchAll(PDO::FETCH_ASSOC);
            foreach($result_stock as $stock){ ?>
                <label for="stock_<?=$stock['id_materiel']?>"> Stock <?=$stock['materiel_titre']?> : </label>
                <input type="number" id="stock_<?=$stock['id_materiel']?>" name="stock[<?=$stock['id_materiel']?>]" value="<?=$stock['stock']?>"> <br> <br>
            <?php
            }
        ?>
        <br>
        <input type="submit" value="Mettre à jour" class="bouton">
    </form>
    <?php
    }
?>

</main>
</body>

</html>