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
    <title>Cours - todoList</title>


</head>

<body>

    <main>

        <?php
        session_start();
        include('nav.php');
        include('connexion.php');

        if (isset($_SESSION["login"])) {
            echo "Bonjour {$_SESSION["login"]}<br>";
        } else {
            echo "nn";
        }
        ?>

        <form action="traite_cours_todo_list.php" method="GET">
            <div class="todo-lists">
                <div class="todo-seul">
                    <input type="checkbox" id="todo" name="todo" checked />
                    <label for="todo">Faire l'ENT</label>
                    <p></p>
                </div>
                <input type="text" id="writetodo" name="writetodo">
                <label for="writetodo">Entrée votre tâche à réaliser</label>
                <br>
                <input type="submit" value="Ajouter">
            </div>
        </form>

    </main>



</body>

</html>