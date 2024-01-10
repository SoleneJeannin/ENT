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

        session_start();
        include('nav.php');

        include('connexion.php');

        $idUser = $_SESSION['id_user'];
        $requeteAdmin = "SELECT * FROM user WHERE id_user=:idUser";
        $stmtAdmin = $db->prepare($requeteAdmin);
        $stmtAdmin->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmtAdmin->execute();
        $resultsAdmin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);
        ?>
        <h1>Inscription des élèves/professeurs</h1>
        <?php
        if (isset($resultsAdmin["ext_role"]) && $resultsAdmin["ext_role"] == 3) {

            ?>
            <form action="inscription_traite.php" method="GET">
                <?php if(isset($_GET["ok"])){
                    ?>
                    <p class="inscription-ok">L'inscription a bien été effectuée !</p>
                    <?php }?>
                <div class="form-container">
                    <div class="part1">
                        <label for="prenom">
                            Insérez son prénom :
                        </label><br>
                        <input type="text" name="prenom" id="prenom" required>

                        <br><br>

                        <label for="nom">
                            Insérez son nom :
                        </label><br>
                        <input type="text" name="nom" id="nom" required>

                        <br><br>

                        <label for="mdp">
                            Insérez son mot de passe provisoire :
                        </label><br>
                        <input type="text" name="mdp" id="mdp" required>

                        <br><br>


                        <label for="role">
                            Insérez son rôle :
                        </label><br>
                        <select name="role" id="role" required>
                            <?php
                            // Récupération des formations existant dans la base de données
                        

                            $requeteRoleExistant = "SELECT DISTINCT ext_role FROM user ";
                            $stmtRoleExistant = $db->prepare($requeteRoleExistant);
                            $stmtRoleExistant->execute();
                            $resultsRoleExistant = $stmtRoleExistant->fetchall(PDO::FETCH_ASSOC);
                            foreach ($resultsRoleExistant as $row) {
                                ?>

                                <option value="<?= $row["ext_role"] ?>">
                                    <?= $row["ext_role"] ?>
                                </option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>
                    <br><br>
                    <div class="part2">
                        <label for="formation">
                            Insérez sa formation :
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
                            Insérez son programme :
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
                            Insérez son groupe :
                        </label><br>
                        <select name="groupe" id="groupe" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>

                        <br><br>

                        <label for="naissance">
                            Insérez sa date de naissance :
                        </label><br>
                        <input type="date" name="naissance" id="naissance" required>
                    </div>

                    <br><br>
                </div>
                <input class="submit-button" type=submit value="Valider votre inscription">
            </form>
            <?php

        }


        ?>

    </main>


</body>

</html>