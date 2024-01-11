<?php
        session_start();
    
        include('connexion.php');
        
        
        ?>

<?php if (isset($_SESSION["login"]) && ($_SESSION["role"]) == 3) { ?>
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
    <link rel="stylesheet" href="inscription.css">
    <title>Inscription</title>


</head>

<body>

    <main>


        <?php
<<<<<<< Updated upstream

        session_start();
        if (isset($_SESSION["login"])) {
=======
 
>>>>>>> Stashed changes
        include('nav_admin.php');
 

        $idUser = $_SESSION['id_user'];
        $requeteAdmin = "SELECT * FROM user WHERE id_user=:idUser";
        $stmtAdmin = $db->prepare($requeteAdmin);
        $stmtAdmin->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmtAdmin->execute();
        $resultsAdmin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);
        ?>
       
        <?php
        if (isset($resultsAdmin["ext_role"]) && $resultsAdmin["ext_role"] == 3) {

            ?>
            <form class="form-inscription" action="inscription_traite.php" method="GET">
            <h1>Inscription des élèves/professeurs</h1>
            <p class="redPetit">Les éléments en <span class="red">*</span> sont obligatoires</p>
                <?php if (isset($_GET["ok"])) {
                    ?>
                    <p class="inscription-ok">L'inscription a bien été effectuée !</p>
                <?php } ?>
                <?php
                if (isset($_GET["loginExistant"])) {
                    ?>
                    <p class="inscription-non">Le login existe déjà</p>
                <?php } ?>

                <div class="form-container">
                    <div class="part1">
                        <label for="prenom">
                            Insérez son prénom<span class="red">*</span> :
                        </label><br>
                        <input type="text" name="prenom" id="prenom" required>

                        <br><br>

                        <label for="nom">
                            Insérez son nom<span class="red">*</span> :
                        </label><br>
                        <input type="text" name="nom" id="nom" required>

                        <br><br>

                        <label for="mdp">
                            Insérez son mot de passe<span class="red">*</span> :
                        </label><br>
                        <input type="text" name="mdp" id="mdp" required>

                        <br><br>


                        <label for="role">
                            Insérez son rôle<span class="red">*</span> :
                        </label><br>
                        <select name="role" id="role" required>
                            <?php


                            // Récupération des formations existant dans la base de données
                        
                            $requeteRoleExistant = "SELECT DISTINCT ext_role FROM user ";
                            $stmtRoleExistant = $db->prepare($requeteRoleExistant);
                            $stmtRoleExistant->execute();
                            $resultsRoleExistant = $stmtRoleExistant->fetchall(PDO::FETCH_ASSOC);
                            foreach ($resultsRoleExistant as $row) {
                                $requeteNomRole = "SELECT role_titre FROM role WHERE id_role=:ext_role";
                                $stmtNomRole = $db->prepare($requeteNomRole);
                                $stmtNomRole->bindParam(':ext_role', $row["ext_role"], PDO::PARAM_INT);
                                $stmtNomRole->execute();
                                $resultsNomRole = $stmtNomRole->fetch(PDO::FETCH_ASSOC);
                                ?>

                                <option value="<?= $row["ext_role"] ?>">
                                    <?= $resultsNomRole["role_titre"] ?>
                                </option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>
                    <br><br>
                    <div class="part2">
                        <label for="formation">
                            Insérez sa formation<span class="red">*</span> :
                        </label><br>
                        <select name="formation" id="formation" required>
                            <?php
                            // Récupération des formations existant dans la base de données
                            $requeteFormationExistant = "SELECT DISTINCT formation FROM user ";
                            $stmtFormationExistant = $db->prepare($requeteFormationExistant);
                            $stmtFormationExistant->execute();
                            $resultsFormationExistant = $stmtFormationExistant->fetchall(PDO::FETCH_ASSOC);
                            foreach ($resultsFormationExistant as $row) {
                                ?>

                                <option value="<?= $row["formation"] ?>">
                                    <?= $row["formation"] ?>
                                </option>
                                <?php
                            }
                            ?>

                        </select>


                        <br><br>
                        <label for="programme">
                            Insérez son programme<span class="red">*</span> :
                        </label><br>
                        <select name="programme" id="programme" required>
                            <?php
                            // Récupération des programmes existants dans la base de données
                            $requeteProgrammeExistant = "SELECT DISTINCT user_programme FROM user";
                            $stmtProgrammeExistant = $db->prepare($requeteProgrammeExistant);
                            $stmtProgrammeExistant->execute();
                            $resultsProgrammeExistant = $stmtProgrammeExistant->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($resultsProgrammeExistant as $row) {
                                ?>
                                <option value="<?= $row["user_programme"] ?>">
                                    <?= $row["user_programme"] ?>
                                </option>

                                <?php
                            }
                            ?>
                        </select>
                        <br><br>

                        <label for="groupe">
                            Insérez son groupe<span class="red">*</span> :
                        </label><br>
                        <select name="groupe" id="groupe" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value=""></option>
                        </select>

                        <br><br>

                        <label for="naissance">
                            Insérez sa date de naissance<span class="red">*</span> :
                        </label><br>
                        <input type="date" name="naissance" id="naissance" required>
                    </div>

                    <br><br>
                </div>
                <input class="submit-button" type=submit value="Valider votre inscription">
            </form>
            <?php

        }}else{
            header("location:login.php?errConnexion");
        }


        ?>

    </main>


</body>

</html>

<?php } else {
            header("location:login.php?errConnexion");
        } ?>