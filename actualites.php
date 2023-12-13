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
    <title>Actualités</title>

    
</head>

<body>

    <main>
    

        <?php

        include('nav.php');
        include('connexion.php');
        session_start();

        $stmt=$db->query("SELECT * FROM user WHERE user_login = '" . $_SESSION['login'] . "'");
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        
        ?>
        
        <div>
            <h2>Les actus <?= $result['user_programme'] ?>:</h2>
            <?php
            //Catégorie à sélectionner

            //table des categories
            $ma_categorie = $result['user_programme'];
            $stmt_cat=$db->query("SELECT id_categorie FROM  categorie WHERE categorie_titre = '$ma_categorie'");
            $id=$stmt_cat->fetchall(PDO::FETCH_ASSOC);
            //table de relation (lien catégorie-actualité)
            $monID = $id[0]['id_categorie'];
            $stmt_cat_actu=$db->query("SELECT ext_actu FROM  categorie_actu WHERE ext_categorie = '$monID'");
            $result_cat_actu=$stmt_cat_actu->fetchall(PDO::FETCH_ASSOC);
            //table des actualités
            $stmt_actu=$db->query("SELECT * FROM actualite WHERE id_actu = $result_cat_actu ");
            $result_pgm=$stmt_pgm->fetchAll(PDO::FETCH_ASSOC);

            //Écrire les actualités qui sont de la bonne catégorie
            foreach($stmt_actu as $actu){ ?>
                <!--Pour que ce soit cliquable-->
                <a class="actu_categ" href="detail_actualite.php?id=<?= $actu["id_actu"]; ?>">
                    <!--Titre-->
                    <h3><?= $actu['materiel_titre']?></h3>
                    <!--Image-->
                    <?= $actu['actu_img']?>
                    <!--Début du contenu-->
                    <?= $actu['actu_text']?>
                </a>
                
            <?php
            }
            ?>

        </div>

    </main>


</body>

</html>