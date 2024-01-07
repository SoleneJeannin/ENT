<!-- 
<img src="./img/actualites/chatgpt.png" alt="">
chatgpt.png

 -->

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&family=Lusitana:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_de_base.css">
    <link rel="stylesheet" href="actualites.css">
    <title>Actualités</title>
</head>

<body>
    <main>

        <?php
        include('nav.php');
        include('connexion.php');
        
        $stmt = $db->query("SELECT * FROM user WHERE user_login = '" . $_SESSION['login'] . "'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <div>
            <h2 class="titre">Les actus <?= $result['user_programme'] ?>:</h2>

            <div class="bloc_mmi">
            <?php
            // Catégorie à sélectionner
            $ma_categorie = $result['user_programme'];
            $stmt_cat = $db->query("SELECT id_categorie FROM categorie WHERE categorie_titre = '$ma_categorie'");
            $id = $stmt_cat->fetch(PDO::FETCH_ASSOC);

            if ($id) {
                // Table de relation (lien catégorie-actualité)
                $monID = $id['id_categorie'];
                $stmt_cat_actu = $db->query("SELECT ext_actu FROM categorie_actu WHERE ext_categorie = '$monID'");
                $result_cat_actu = $stmt_cat_actu->fetchAll(PDO::FETCH_ASSOC);

                // Écrire les actualités qui sont de la bonne catégorie
                foreach ($result_cat_actu as $cat_actu) { //Pour que plusieurs actulaités s'affichent et pas juste la première qui est liée
                    $id_actu = $cat_actu['ext_actu'];
                    $stmt_actu = $db->query("SELECT * FROM actualite WHERE id_actu = $id_actu");
                    $result_pgm = $stmt_actu->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result_pgm as $actu) {
                        ?>
                        <!-- Pour que ce soit cliquable -->
                        <a class="actu_categ" href="detail_actualite.php?id=<?= $actu["id_actu"]; ?>">
                            <div class="un_mmi">
                                <!-- Titre -->
                                <h3><?= $actu['actu_titre'] ?></h3>
                                <!-- Image -->
                                <img class="img_actu" src="./img/actualites/<?= $actu['actu_img'] ?>" alt="">
                                <!-- Début du contenu -->
                                <p><?= $actu['actu_accroche'] ?></p>
                                <p class="ma_cat"><?= $ma_categorie ?></p>
                            </div>
                        </a>
            <?php
                    }
                }
            }
            ?>
            </div>
        </div>
        <br><br>
        <div class="toutes_actus">
            <h2 class="titre">Toutes les actus :</h2>
            <div class="bloc_global_actus">
                <?php
                $stmt_tt_actu = $db->query("SELECT * FROM actualite");
                $result_tt_actus = $stmt_tt_actu->fetchAll(PDO::FETCH_ASSOC);
                //Afficher l'article
                foreach ($result_tt_actus as $row){ ?>
                    <a class="actu_categ" href="detail_actualite.php?id=<?= $row["id_actu"]; ?>">
                        <div class="actu">
                            <!-- Titre -->
                            <h3><?= $row['actu_titre'] ?></h3>
                            <!--Texte-->
                            <p><?= $row['actu_accroche'] ?></p>
                            <!--Image-->
                            <img class="img_actu" src="./img/actualites/<?= $row['actu_img'] ?>" alt="">
                            <?php
                            //Récupérer les catégories de chaque article
                            $id_actu = $row['id_actu'];
                            //Passage dans la table de relation (actu-catégorie)
                            $stmt_cat_actu_2 = $db->query("SELECT * FROM categorie_actu, categorie WHERE ext_actu = $id_actu AND ext_categorie = id_categorie");
                            $result_cat_actu_2 = $stmt_cat_actu_2->fetchAll(PDO::FETCH_ASSOC);
                            //Table des catégories
                            
                            // Écrire les actualités qui sont de la bonne catégorie
                            foreach ($result_cat_actu_2 as $row2) { ?>
                                <p class="ma_cat"><?= $row2['categorie_titre'] ?></p>
                            <?php
                            } ?>
                        </div>
                    </a>
                    <?php } ?>
            </div>
        </div>
        <br><br>
    </main>
</body>

</html>