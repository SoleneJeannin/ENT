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
    <title>Cours - contenu</title>


</head>

<body>

    <main>
        <?php
        include('nav.php');
        include('connexion.php');
        ?>
        <!-- Note à plus tard à moi même
        : Je souhaite afficher le contenu de cours de chaque matière avec l'idetifiant correspondant. Un cours possède plusieurs contenu. Ainsi, je veux faire une condition pour savoir si la clé externe du contenu correspondent bien à l'identifiant de du cours en question.
    -->
        <?php
        $requeteContenu = "SELECT * FROM matiere_contenu";
        $stmtContenu = $db->prepare($requeteContenu);
        $stmtContenu->execute();
        $resultsContenu = $stmtContenu->fetchAll(PDO::FETCH_ASSOC);

        if (isset($_GET["id"])) {
            foreach ($resultsContenu as $row) {
                ?>

                <?= $row["matiere_contenu_titre"] ?><br>

                <?php
            }
        } ?>



    </main>


</body>

</html>