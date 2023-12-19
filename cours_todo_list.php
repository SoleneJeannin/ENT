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
    <link rel="stylesheet" href="style_de base.css">
    <link rel="stylesheet" href="cours_todo_list.css">
    <title>Cours - todoList</title>


</head>

<!-- ---------Écrire une todolist et l'afficher -->
<!-- ---------Supprimer ma todolist -->
<!-- Quand je coche, change le status de la todo -->
<!----------- Je souhaite pouvoir voir seulement si la todolist m'appartient -->

<body>

    <main>

        <?php

        include('nav.php');
        include('connexion.php');

        if (isset($_SESSION["login"])) {
            echo "Bonjour {$_SESSION["login"]}<br>";
        } else {
            echo "nn";
        }
        ?>


        <div class="todo-lists">
            <?php

            if (isset($_GET['reactualisationTodo'])) {
                $requeteTodo = 'SELECT * FROM todo_list WHERE ext_user=:id ORDER BY todo_list_status';
            } else {
                $requeteTodo = 'SELECT * FROM todo_list WHERE ext_user=:id';
            }


            $idUser = $_SESSION['id_user'];


            $stmt = $db->prepare($requeteTodo);
            $stmt->bindParam(':id', $idUser, PDO::PARAM_INT);
            $stmt->execute();

            $resultTodo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $compteTodo= 0;
            $compteTodoCheck = 0;
            foreach ($resultTodo as $row) {
                if ($row["todo_list_status"] == 1){
                    $compteTodoCheck++ ;
                }
                ?>
                <div class="todo-seul">
                    <!-- Formulaire pour le checkbox dans bdd -->
                    <form action="cours_todo_checkbox.php">
                        <input type="checkbox" id="todo<?= $row["id_todo_list"] ?>" name="todo<?= $row["id_todo_list"] ?> "
                            <?= $row["todo_list_status"] == 1 ? 'checked' : '' ?> onclick="updateDatabase(this)" />
                        <!-- Je souhaite récupérer la valeur du status -->
                        <label for="todo<?= $row["id_todo_list"] ?>">
                            <?= $row["todo_list_text"] ?>
                        </label>
                    </form>
                    <!-- Formulaire pour supprimer todo dans bdd -->
                    <form action="cours_todo_list_supprime.php" method="GET">
                        <input type="hidden" name="idTodo" value="<?= $row["id_todo_list"] ?>">
                        <input type="submit" value="Supprimer">
                    </form>
                </div>
            <?php 
        $compteTodo++;
        
        } ?>
        <?php echo round(($compteTodoCheck*100)/$compteTodo, 1) . "% des tâches réalisés" ?>
            <form action="cours_todo_list.php">
                <input type="submit" name="reactualisationTodo" value="Réactualiser votre todolist">
            </form>
            <!-- Formulaire pour ajouter une todo dans bdd -->
            <form action="cours_todo_list_traite.php" method="GET">
                <input type="text" id="writetodo" name="writetodo">
                <label for="writetodo">Entrée votre tâche à réalirserarezfqd</label>
                <br>
                <input type="submit" value="Ajouter">
            </form>
        </div>
    </main>


    <script>
        // CHATGPTTTTTTT
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

    <!-- JQUERY pour récupérer valeur checkbox dans bdd sans submit ??? IDEM CHATGPTTTTTTT  -->
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

</body>

</html>