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
    <link rel="stylesheet" href="retard.css">
    <title>Document, retard, absence</title>


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
        session_start();
        if (isset($_SESSION['role']) && $_SESSION['role'] == 3) {
            include('nav_admin.php');
        } else {
            include('nav.php');
        }
        include('connexion.php');

        if (isset($_SESSION['login'])) {
            $user = $_SESSION['login'];

            $stmt_user = $db->query("SELECT * FROM user WHERE user_login = '$user' ");
            $result_user = $stmt_user->fetch(PDO::FETCH_ASSOC);

            $num_role = $result_user['ext_role'];

            $stmt_role = $db->query("SELECT * FROM role WHERE id_role = $num_role ");
            $result_role = $stmt_role->fetch(PDO::FETCH_ASSOC);

            $role = $result_role['role_titre'];
        }
        //Si on est étudiant
        if ($role == 'Étudiant') {
            //Récupération de l'utilisateur
            $stmt = $db->query("SELECT * FROM user WHERE user_login = '" . $_SESSION['login'] . "'");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id_user'] = $result['id_user'];
            ?>


            <h1 class="titre_doc">Mes documents</h1>
            <div class="bloc_document">
                <div class="first_colonne">
                    <a href="./document/étudiants/<?= $_SESSION['id_user'] ?>/certificat_sco.pdf"
                        class="lien_document">Certificat de scolarité</a>
                    <a href="./document/étudiants/<?= $_SESSION['id_user'] ?>/bourse.pdf" class="lien_document">Notification
                        conditionnelle de bourse</a>
                    <a href="./document/étudiants/<?= $_SESSION['id_user'] ?>carte_etu.pdf" class="lien_document">Carte
                        étudiant éléctronique</a>
                </div>

                <div class="ligne"></div>
                <div class="second_colonne">
                    <a href="./document/étudiants/<?= $_SESSION['id_user'] ?>/stage1.pdf" class="lien_document">Contrat de
                        stage (2e semestre)</a>
                    <a href="./document/étudiants/<?= $_SESSION['id_user'] ?>/stage2.pdf" class="lien_document">Contrat de
                        stage (4e semestre)</a>
                    <a href="./document/étudiants/<?= $_SESSION['id_user'] ?>/alternance.pdf" class="lien_document">Contrat
                        d'alternance</a>
                </div>
            </div>
            <br>
            <div class="bloc_abs_retard">
                <div class="bloc_retard">
                    <h2><img src="./img/nav/clock.svg" alt="">Retards :</h2>
                    <p>
                        <?= $result['user_retard'] ?> minutes
                    </p>
                </div>
                <div class="bloc_abs">
                    <?php
                    //Récupérer les absences de l'utilisateur
                    $id_user = $_SESSION['id_user'];

                    $stmt2 = $db->query("SELECT * FROM absence WHERE ext_etudiant = '" . $id_user . "'");
                    $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    $abs_justif = 0;
                    $abs_non_justif = 0;
                    foreach ($result2 as $row) {
                        //Si le champ "jusitifcation" n'est pas vide (que l'absence est justifiée)
                        if (isset($row['abs_justificatif'])) {
                            //Additionner toutes les absences
                            $abs_justif = $abs_justif + $row['abs_duree'];
                        }
                        //Si le champ "jusitifcation" vaut "NULL" (que l'absence est NON justifiée)
                        else {
                            $abs_non_justif = $abs_non_justif + $row['abs_duree'];
                        }
                    }

                    ?>
                    <h2><img src="./img/nav/user.svg" alt=""> Absences :</h2>
                    <p>
                        <?= $abs_justif ?> heure(s) justifiée(s) <br>
                        <?= $abs_non_justif ?> heure(s) non justifiée(s)
                    </p>
                </div>
            </div>
            <br><br>
            <div class="contain-info-img">
                <img src="./img/nav/info.svg" alt="information">
                <p class="info">Si vous avez des questions sur vos démarches administratives, vous pouvez vous adresser à
                    votre
                    responsable pédagogique : Sophie DAVID</p>
            </div>


            <?php
        } //Si on est admin
        elseif ($role == 'Admin') {

            //Si on vient d'ajouter un/e retard/absence'
            if(isset($_GET['etat'])){ 
                if($_GET['etat']=='misajour') {?>

                <div class="popup">
                    <p>Les retards et absences ont bien été mises à jour !'</p>
                </div>
                
                <?php 
                //Appel la fonction js qui fait apparaitre la popup
                echo "<script> popup(); </script>"; 
            }}


            $stmt_admin = $db->query("SELECT * FROM user WHERE ext_role = 1");
            $result_admin = $stmt_admin->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h1 class="titre_admin">Absences et retards des étudiants</h1>

            <div class="bloc_de_form">
            <form action="traite_retard.php" method="POST">
                <!-- Sélectionner un étudiant -->
                <div>
                <select name="etudiant" id="etudiant">
                    <option value="0">--Sélectionnez l'étudiant--</option>
                    <?php foreach ($result_admin as $row2): ?>
                        <option value="<?= $row2['id_user'] ?>">
                            <?= $row2['user_prenom'] . ' ' . $row2['user_nom'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                </div>
                <br>

                <!-- Sélectionner son nombre de nouveaux retards/absences -->
                <div>
                <label for="retard">Nouveau(x) retard(s) en minute(s): </label>
                <input type="number" name="retard" id="retard">
                </div>

                
                <p class="abs_admin">Absence(s) : </p>

                <div>
                <label for="duree">Nombre d'heure(s) : </label>
                <input type="number" name="duree" id="duree">
                </div>

                <div>
                <label for="cours">Cours : </label>
                <input type="number" name="cours" id="cours">
                </div>

                <div>
                <label for="justif">Si l'absence est justifiée, entrer le motif : </label>
                <input type="text" name="justif" id="justif">
                </div>

                <br>
                <div>
                <input type="submit" value="Mettre à jour" class="bouton">
                </div>
                <br>
            </form>
            </div>
            <?php
        }
        ?>
    </main>


</body>

</html>