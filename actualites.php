<!-- 
<img src="./img/actualites/chatgpt.png" alt="">
chatgpt.png
-->

<?php 

        
 include('connexion.php');

  session_start();
 if (isset($_SESSION["login"]) && ($_SESSION["role"]) == 1 || ($_SESSION["role"]) == 2 || ($_SESSION["role"]) == 3) {
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

    <script>
        //Apparition de la popup pour l'admin
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
       
        if (isset($_SESSION['role']) && $_SESSION['role'] == 3) {
            include('nav_admin.php');
        } elseif(isset($_SESSION['role']) && $_SESSION['role'] == 2) {
            include('nav-teacher.php');
        }else{
            include('nav.php');
        }
    
        

        if (isset($_SESSION['login'])) {
            $user = $_SESSION['login'];

            $stmt_user = $db->query("SELECT * FROM user WHERE user_login = '$user' ");
            $result_user = $stmt_user->fetch(PDO::FETCH_ASSOC);

            $num_role = $result_user['ext_role'];

            $stmt_role = $db->query("SELECT * FROM role WHERE id_role = $num_role ");
            $result_role = $stmt_role->fetch(PDO::FETCH_ASSOC);

            $role = $result_role['role_titre'];
        }

        //Si on est étudiant ou professeur
        if ($role == 'Étudiant' || $role == 'Professeur') {

            $stmt = $db->query("SELECT * FROM user WHERE user_login = '" . $_SESSION['login'] . "'");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>

            <div>
                <h2 class="titre">Les actus <?= $result['formation'] ?>:</h2>

                <div class="bloc_mmi">
                <?php
                // Catégorie à sélectionner
                $ma_categorie = $result['formation'];
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
        <?php } 
        
        //Si on est admin
        elseif($role == 'Admin') {

            //Si on vient d'ajouter une article'
            if(isset($_GET['etat'])){ 
                if($_GET['etat']=='cree') {?>

                <div class="popup">
                    <p>L'article a bien été ajouté !'</p>
                </div>
                
                <?php 
                //Appel la fonction js qui fait apparaitre la popup
                echo "<script> popup(); </script>"; 
            }}

            ?>
            <h1>Nouvelle actualité</h1>
            <form action="traite_actualites.php" method="POST">
                <label for="nvo_titre">Titre du nouvel article : </label>
                <input type="text" id="nvo_titre" name="nvo_titre" required> <br>
                <label for="nvo_accroche">Accroche du nouvel article : </label> 
                <input type="text" id="nvo_accroche" name="nvo_accroche" required> <br>
                <label for="nvo_texte">Contenu du nouvel article : </label>
                <input type="text" id="nvo_texte" name="nvo_texte" required> <br> 
                <!--Checkbox des catégories de l'article-->
                <fieldset>
                    <legend>Catégorie(s) du nouvel article :</legend>
                    <?php
                    $stmt_categ = $db->query("SELECT * FROM categorie");
                    $result_categ = $stmt_categ->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result_categ as $categ) {
                        ?>
                        <div>
                        <input type="checkbox" id="<?= $categ['id_categorie'] ?>" name="categ[]" value="<?= $categ['id_categorie'] ?>" />
                        <label for="<?= $categ['id_categorie'] ?>"><?= $categ['categorie_titre'] ?></label>
                        </div>
                    <?php
                    }
                    ?>
                    
                </fieldset>
                    <br> 
                    <br>
                    <input type="submit" name="modif_contenu" value="Créer l'article" class="bouton">
            </form>
        <?php        
        }}else{
            header("location:login.php?errConnexion");
        }
        ?>
    </main>
</body>

</html>