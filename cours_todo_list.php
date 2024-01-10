<?php session_start(); ?>
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
    <link rel="stylesheet" href="cours_todo_list.css">
    <title>Cours</title>


</head>

<body>

    <main>

        <?php

        include('nav.php');
        include('connexion.php');

        if (isset($_SESSION["login"])) {

            ?>

            <div class="container-cours-todo">


                <div class="cours">
                    <h2>Vos Cours</h2>
                    <?php

                    // Je vérifie que l'utilisateur logué soit dans le bon programme.
                    $idUser = $_SESSION['id_user'];
                    $requeteProgrammeUser = "SELECT user_programme FROM user WHERE id_user=:idUser";
                    $stmtProgrammeUser = $db->prepare($requeteProgrammeUser);
                    $stmtProgrammeUser->bindParam(':idUser', $idUser, PDO::PARAM_INT);
                    $stmtProgrammeUser->execute();
                    $resultsProgrammeUser = $stmtProgrammeUser->fetch(PDO::FETCH_ASSOC);

                    // Je récupère les informations de la table cours
                    $requeteCours = "SELECT * FROM matiere";
                    $stmtCours = $db->prepare($requeteCours);
                    $stmtCours->execute();
                    $resultsCours = $stmtCours->fetchAll(PDO::FETCH_ASSOC);

                    ?>
                    <!-- Vérifie le programme de l'utilisateur -->
                    <!-- L'utilisateur est de programme :
                    <?= $resultsProgrammeUser["user_programme"]; ?> -->
                    
                    <?php

                    $CoursProgramme = false;

                    foreach ($resultsCours as $row) {
                        $programme = $row["programme"];
                        // Pour chaque cours je vérifie qu'il est du programme
                        if (isset($resultsProgrammeUser["user_programme"]) && $resultsProgrammeUser["user_programme"] == $programme) {
                            $CoursProgramme = true;
                            $requeteProfesseur = "SELECT user_nom,user_prenom FROM user WHERE id_user=:ext_prof";
                            $stmtProfesseur = $db->prepare($requeteProfesseur);
                            $stmtProfesseur->bindParam(':ext_prof', $row["ext_prof"], PDO::PARAM_INT);
                            $stmtProfesseur->execute();
                            $resultsProfesseur = $stmtProfesseur->fetch(PDO::FETCH_ASSOC);

                            $couleur = $row["couleur"];
                            // Vérifie que la condition "$couleur" soit égale à blue, si oui alors $style="color-blue", sinon rien.
                            if ($style = ($couleur == "blue")) {
                                $style = "color-red";
                            } elseif ($style = ($couleur == "red")) {
                                $style = "color-blue";
                            } elseif ($style = ($couleur == "green")) {
                                $style = "color-green";
                            } else {
                                $style = "";
                            }


                            ?>

                            <a href="cours.php?id=<?= $row["ext_contenu"] ?>" class="cours-link">
                                <div class="<?= $style ?> cours-solo cours<?= $row["id_matiere"] ?>">
                                    <p class="nom-matiere">
                                        <?= $row["nom_matiere"] ?>
                                    </p><br>
                                    <p class="nom-prof">
                                        <?= ucwords($resultsProfesseur["user_nom"]) . " " . ucwords($resultsProfesseur["user_prenom"]) ?>
                                    </p>
                                </div>
                            </a>


                            <?php
                        }

                    }
                    if (!$CoursProgramme) {
                        echo "Vous n'avez pas de cours dans votre programme";
                    }

                    ?>
                </div>



                <div class="todo-lists">
                    <h2>Votre TodoList</h2>


                    <?php

                    if (isset($_GET['reactualisationTodo'])) {
                        $requeteTodo = 'SELECT * FROM todo_list WHERE ext_user=:id ORDER BY todo_list_status';
                    } else {
                        $requeteTodo = 'SELECT * FROM todo_list WHERE ext_user=:id';
                    }





                    $stmt = $db->prepare($requeteTodo);
                    $stmt->bindParam(':id', $idUser, PDO::PARAM_INT);
                    $stmt->execute();

                    $resultTodo = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (empty($resultTodo)) {



                    } else {
                        ?>
                        <form class="actualisation" action="cours_todo_list.php">
                            <input class="reactualisation" type="submit" name="reactualisationTodo"
                                value="Réactualisation du Todo">
                        </form>
                        <?php
                    }
                    if (empty($resultTodo)) {
                        ?>
                        <p class="task-none">Aucune tâches</p>
                        <?php
                    } else {
                        $compteTodo = 0;
                        $compteTodoCheck = 0;
                        foreach ($resultTodo as $row) {
                            if ($row["todo_list_status"] == 1) {
                                $compteTodoCheck++;
                            }

                            ?>
                            <div class="todo-seul">
                                <!-- Formulaire pour le checkbox dans bdd -->
                                <form action="cours_todo_checkbox.php">
                                    <input type="checkbox" id="todo<?= $row["id_todo_list"] ?>"
                                        name="todo<?= $row["id_todo_list"] ?> " <?= $row["todo_list_status"] == 1 ? 'checked' : '' ?>
                                        onclick="updateDatabase(this)" />
                                    <!-- Je souhaite récupérer la valeur du status -->
                                    <label class="todo-text" for="todo<?= $row["id_todo_list"] ?>">
                                        <?= $row["todo_list_text"] ?>
                                    </label>
                                </form>
                                <!-- Formulaire pour supprimer todo dans bdd -->
                                <form action="cours_todo_list_supprime.php" method="GET">
                                    <input type="hidden" name="idTodo" value="<?= $row["id_todo_list"] ?>">
                                    <input class="supprimer" type="submit" value="Supprimer">
                                </form>
                            </div>
                            <?php
                            $compteTodo++;

                        }
                        ?>
                        <div class="pourcentage">
                            <?php echo round(($compteTodoCheck * 100) / $compteTodo, 1) . "% des tâches réalisés" ?>
                        </div>
                        <?php
                    } ?>


                    <!-- Formulaire pour ajouter une todo dans bdd -->
                    <form class="ajout-todo" action="cours_todo_list_traite.php" method="GET">
                        <br>
                        <label for="writetodo">Entrée votre tâche à réaliser</label>
                        <br>
                        <input type="text" id="writetodo" name="writetodo">
                        <br>
                        <br>
                        <input class="ajout-btn" type="submit" value="Ajouter">
                    </form>
                </div>
            </div>
        </main>
    <?php } else {
            echo "Vous n'êtes pas connecté";
        } ?>

    <script>
        // Aidé par ChatGPT 
        function updateDatabase(checkbox) {
            var isChecked = checkbox.checked;
            var todoId = checkbox.id.replace("todo", "");

            // Envoi des données au serveur avec AJAX
            $.ajax({
                type: 'GET',
                url: 'cours_todo_checkbox.php',
                data: { todoId: todoId, isChecked: isChecked },
                success: function (response) {
                    // Gérer la réponse du serveur si nécessaire
                    console.log(response);
                },
                error: function (error) {
                    // Gérer les erreurs de la requête AJAX si nécessaire
                    console.error(error);
                }
            });
        }

    </script>

    <!-- JQUERY pour récupérer valeur checkbox dans bdd sans submit -->
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

</body>

</html>