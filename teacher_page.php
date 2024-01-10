<?php
include('connexion.php');
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
    <title>ENT Enseignant - Université Gustave Eiffel</title>


</head>

<body>

    <main>


        <?php


        include('nav-teacher.php');


        ?>


        <div class="big-wrapper">
            <div class="matieres">
                <h1>Mes matiers</h1>

<style>
    .matiere-block {
        background-color: var(--grey);
        padding: 15px 20px;
        border-radius: 15px;
    }

    .matiere-block a{
    color: black;
text-decoration: none;}

    .one-matiere:hover{
    background-color: var(--yellow1);}

    .one-matiere {
        background-color: white;
        padding: 5px 20px;
        margin: 8px auto;
        border-radius: 5px;
    }

    .matieres {
        width: 80%;
        padding: 40px 100px;
    }

    @media (max-width:900px) {
        .matieres {
        width: 100%;
        padding: 40px 50px;
        margin: auto;
    }
    }

    .big-wrapper {
        width: 100%;
    }
</style>

                <div class="matiere-block">
                    <?php
                    
                    $idProf = $_SESSION['id_user'];

                    $requete2 = " SELECT * FROM `matiere` WHERE ext_prof = :id ";
                    $stmt2 = $db->prepare($requete2);
                    $stmt2->bindValue(':id', $idProf, PDO::PARAM_INT);

                    $stmt2->execute();
                    $matieres = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($matieres as $matiere) {


                    ?>



                        <a href="teacher_matier.php?id_matiere=<?= $matiere['id_matiere'] ?>">
                            <div class="one-matiere">
                                <h2> <?= $matiere['nom_matiere'] ?> </h2>
                            </div>
                        </a>

                    <?php }; ?>

                </div>

            </div>

            <div class="agenda">

            </div>
        </div>



    </main>


</body>

</html>