<?php
include('connexion_offline.php');
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
    <title>Évaluations</title>


</head>

<body>

    <main>


        <?php

        include('nav.php');

        ?>



        <style>
            h1 {
                font-family: 'Lusitana', serif;
                margin-left: 4vw;
            }

            main {}


            .wrapper {
                background-color: var(--grey);
                width: 86%;
                height: 28vh;
                margin: auto;
                border-radius: 15px;
                overflow-y: scroll;
            }

            .one-eval {
                display: flex;
                justify-content: space-between;
                width: 90%;
                background-color: white;
                margin: 10px 30px 10px 50px;
                border-radius: 15px;
                padding: 10px 50px 10px 50px;
            }

            .one-eval a:not(.title-eval) {
                display: block;
                margin-left: 5%;
                color: var(--balck);
                font-size: 0.9rem;
                margin-bottom: 3px;
                cursor: pointer;
            }

            .one-eval h2,
            .one-eval p {
                margin: 0;
            }

            .one-eval h2 {
                margin-bottom: 5px;
            }


            .left-info-eval {
                width: 50%;

            }

            .right-info-eval {
                text-align: right;

            }

            .date-eval {

                font-weight: 600;
                font-size: 1.3rem;
            }

            .deposer {
                /* background-color: var(--red); */
                border: none;
                font-size: 1rem;
                background-color: white;
                text-decoration: underline;
                padding: 10px 0;
                font-family: 'Lexend Deca', sans-serif;
            }


            .right-info-eval button {
                cursor: pointer;
            }

            .note {

                padding: 10px 0;
            }
        </style>

        <div id="future">

            <h1>Evaluations prochaines</h1>
            <div class="wrapper-future wrapper">


                <!-- dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd -->

                <?php
                $requete = "

                SELECT
        title_projet,
        eval_date_fin,
        eval_date_debut,
        nom_matiere,
        coefficient,
        note,
        commentaire_prof,
        eval_projet.ext_etudiant AS etudiant_id,
        matiere.ext_prof AS prof_id,
        user_etudiant.user_nom AS etudiant_nom,
        user_prof.user_nom AS prof_nom,
        user_prof.user_prenom AS prof_prenom,
        type
    FROM
        eval_projet
    JOIN matiere ON eval_projet.ext_matiere = matiere.id_matiere
    JOIN user AS user_etudiant ON eval_projet.ext_etudiant = user_etudiant.id_user
    JOIN user AS user_prof ON matiere.ext_prof = user_prof.id_user
    WHERE
        eval_projet.eval_date_fin > NOW()

    UNION
    SELECT
        title_exam,
        cours_temps_fin,
        cours_temps_debut,
        nom_matiere,
        coefficient,
        note,
        commentaire,
        eval_exam.ext_etudiant AS etudiant_id,
        matiere.ext_prof AS prof_id,
        user_etudiant.user_nom AS etudiant_nom,
        user_prof.user_nom AS prof_nom,
        user_prof.user_prenom AS prof_prenom,
        type
    FROM
        eval_exam
    JOIN cours ON cours.id_cours = eval_exam.ext_cours
    JOIN matiere ON matiere.id_matiere = cours.ext_matiere
    JOIN user AS user_etudiant ON eval_exam.ext_etudiant = user_etudiant.id_user
    JOIN user AS user_prof ON matiere.ext_prof = user_prof.id_user
    WHERE
        cours.cours_temps_fin > NOW();
                
            ";

                $stmt = $db->query($requete);
                $evals = $stmt->fetchAll(PDO::FETCH_ASSOC);





                foreach ($evals as $row) {





                    // current date time
                    $currentDateTime = new DateTime();
                    $now = $currentDateTime->format('Y-m-d H:i:s');
                    $currentTime = $currentDateTime->format('H:i');
                    $currentDate = $currentDateTime->format('j F Y');




//format date and time
$deadlineDate = new DateTime($row['eval_date_fin']);
$deadlineDateFormatted = $deadlineDate->format('j F Y'); //day of exam or project

$deadlineTime = new DateTime($row['eval_date_debut']);
$deadlineTimeFormatted = $deadlineDate->format('H:i'); //last time for exam and project

$startDate = new DateTime($row['eval_date_debut']);
$startTime = $startDate->format('H:i'); // start of exam


// echo $deadlineDateFormatted, "   deadlineDateFormatted   ", $deadlineTimeFormatted, "  $deadlineTimeFormatted  ", $startTime;


                ?>


                    <!-- one eval  type devoir -->
                    <div class="one-eval">

                        <div class="left-info-eval">
                            <a class="title-eval" href="#">
                                <h2> <?php if ($row['type'] == 1) : ?>
                                        <span>Examen:</span>
                                    <?php elseif ($row['type'] == 2) : ?>
                                        <span>Projet:</span>
                                    <?php endif; ?>



                                    <?= $row['title_projet'] ?? '' ?>
                                </h2>
                            </a>
                            <a href="#"> <?= $row['nom_matiere'] ?? '' ?></a>
                            <a href=""> <?= $row['prof_prenom'] . ' ' . $row['prof_nom'] ?? '' ?></a>
                        </div>


                        <?php if ($row['type'] == 1) : ?>
                          

                            <div class="right-info-eval">
                                <p class="date-eval"><?= $deadlineDateFormatted ?? '' ?></p>
                                <p> <?= $startTime. " - ". $deadlineTimeFormatted ?? '' ?></p>
                                <p class="deposer">Salle 32</p>
                            </div>



                        <?php elseif ($row['type'] == 2) : ?>
                          
                            <div class="right-info-eval">
                                <p class="date-eval"><?= $deadlineDateFormatted ?? '' ?></p>
                                <p>jusqu'à <?= $deadlineTimeFormatted ?? '' ?></p>
                                <button class="deposer">Deposer le travail</button>
                            </div>

                        <?php endif; ?>



                    </div>

                    <!-- one eval end -->







                <?php

                };
                ?>


                <!-- dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd -->










            </div>


        </div>

        <div id="past">
            <h1>Evaluations passées</h1>

            <div class="wrapper-past wrapper">





            <?php
                $requete2 = "

                SELECT
        title_projet,
        eval_date_fin,
        eval_date_debut,
        nom_matiere,
        coefficient,
        note,
        commentaire_prof,
        eval_projet.ext_etudiant AS etudiant_id,
        matiere.ext_prof AS prof_id,
        user_etudiant.user_nom AS etudiant_nom,
        user_prof.user_nom AS prof_nom,
        user_prof.user_prenom AS prof_prenom,
        type
    FROM
        eval_projet
    JOIN matiere ON eval_projet.ext_matiere = matiere.id_matiere
    JOIN user AS user_etudiant ON eval_projet.ext_etudiant = user_etudiant.id_user
    JOIN user AS user_prof ON matiere.ext_prof = user_prof.id_user
    WHERE
        eval_projet.eval_date_fin <= NOW()

    UNION
    SELECT
        title_exam,
        cours_temps_fin,
        cours_temps_debut,
        nom_matiere,
        coefficient,
        note,
        commentaire,
        eval_exam.ext_etudiant AS etudiant_id,
        matiere.ext_prof AS prof_id,
        user_etudiant.user_nom AS etudiant_nom,
        user_prof.user_nom AS prof_nom,
        user_prof.user_prenom AS prof_prenom,
        type
    FROM
        eval_exam
    JOIN cours ON cours.id_cours = eval_exam.ext_cours
    JOIN matiere ON matiere.id_matiere = cours.ext_matiere
    JOIN user AS user_etudiant ON eval_exam.ext_etudiant = user_etudiant.id_user
    JOIN user AS user_prof ON matiere.ext_prof = user_prof.id_user
    WHERE
        cours.cours_temps_fin <= NOW();
                
            ";

                $stmt2 = $db->query($requete2);
                $evals2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);





                foreach ($evals2 as $row2) {





//format date and time
$deadlineDate = new DateTime($row2['eval_date_fin']);
$deadlineDateFormatted = $deadlineDate->format('j F Y'); //day of exam or project

$deadlineTime = new DateTime($row2['eval_date_debut']);
$deadlineTimeFormatted = $deadlineDate->format('H:i'); //last time for exam and project

$startDate = new DateTime($row2['eval_date_debut']);
$startTime = $startDate->format('H:i'); // start of exam


// echo $deadlineDateFormatted, "   deadlineDateFormatted   ", $deadlineTimeFormatted, "  $deadlineTimeFormatted  ", $startTime;


                ?>





                <!-- one eval  type noted -->
                <div class="one-eval">

                <div class="left-info-eval">
                            <a class="title-eval" href="#">
                                <h2> <?php if ($row2['type'] == 1) : ?>
                                        <span>Examen:</span>
                                    <?php elseif ($row2['type'] == 2) : ?>
                                        <span>Projet:</span>
                                    <?php endif; ?>



                                    <?= $row2['title_projet'] ?? '' ?>
                                </h2>
                            </a>
                            <a href="#"> <?= $row2['nom_matiere'] ?? '' ?></a>
                            <a href=""> <?= $row2['prof_prenom'] . ' ' . $row2['prof_nom'] ?? '' ?></a>
                        </div>





                    <div class="right-info-eval">
                        <p class="date-eval"><?= $deadlineDateFormatted ?? '' ?></p>
                        <p class="note">Note: <span><?= " " . $row2['note'] . ' / 20' ?? 'pas evalué' ?> </span></p>
                    </div>
                </div>

                <!-- one eval end-->

                <?php

};
?>


            </div>
        </div>













        <div style="display: none;">
            <!-- one eval  type devoir -->
            <div class="one-eval">

                <div class="left-info-eval">
                    <a class="title-eval" href="#">
                        <h2><span>Devoir:</span> Anglais </h2>
                    </a>
                    <a href="#"> R1.2 Angalais</a>
                    <a href="">Alexander Leroi</a>
                </div>

                <div class="right-info-eval">
                    <p class="date-eval">12 december 2023</p>
                    <p>jusqu'à 23:03</p>
                    <button class="deposer">Deposer le travail</button>
                </div>
            </div>

            <!-- one eval end-->


            <!-- one eval  type Exam -->
            <div class="one-eval">

                <div class="left-info-eval">
                    <a class="title-eval" href="">
                        <h2><span>Examen:</span> Anglais </h2>
                    </a>
                    <a href="#"> R1.2 Angalais</a>
                    <a href="">Alexander Leroi</a>
                </div>

                <div class="right-info-eval">
                    <p class="date-eval">12 december 2023</p>
                    <p>12:30 - 13:30</p>
                    <p class="deposer">Salle 32</p>
                </div>
            </div>

            <!-- one eval end-->

        </div>
    </main>


</body>

</html>