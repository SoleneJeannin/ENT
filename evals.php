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
    <link rel="stylesheet" href="style_de base.css">
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
                <!-- requet pour exam -->
                <?php
                $requete = "SELECT * FROM eval_projet, matiere, cours, user WHERE cours.ext_matiere = matiere.id_matiere AND eval_projet.ext_etudiant = user.id_user AND eval_projet.ext_cours = cours.id_cours;
                
            ";

                $stmt = $db->query($requete);
                $evals = $stmt->fetchAll(PDO::FETCH_ASSOC);





                foreach ($evals as $row) {



                    // current date time
                    $currentDateTime = new DateTime();
                    $now = $currentDateTime->format('Y-m-d H:i:s');
                    $currentTime = $currentDateTime->format('H:i');
                    $currentDate = $currentDateTime->format('j F Y');

                    // Format date for exam
                    $date = new DateTime($row['cours_date'] ?? '1900-01-01');
                    $formattedDate = $date->format('j F Y'); //date of eval to compare

                    // Format time for examen
                    $timeStart = new DateTime($row['cours_temps_debut']);
                    $timeEnd = new DateTime($row['cours_temps_fin']);
                    $formattedTime = $timeStart->format('H:i') . ' - ' . $timeEnd->format('H:i');
                    $formattedDeadline = $timeEnd->format('H:i'); //time of eval to compare


                    //combined deadline time for examen

                    $combinedDateTimeString = $row['cours_date'] . ' ' . $row['cours_temps_fin'];
                    $combinedDateTimeExam = new DateTime($combinedDateTimeString);
                    $combinedDateTimeExamFormattedtoCompare = $combinedDateTimeExam->format('Y-m-d H:i:s');


                    //format date and time for devoir

                    $devoir = new DateTime($row['eval_date_fin'] ?? '1900-01-01');
                    $devoirFormattedtoCompare = $devoir->format('Y-m-d H:i:s');
                    $dateDevoir = $devoir->format('j F Y');
                    $timeDevoir = $devoir->format('H:i');

                    echo $now, "NOOOW", $devoirFormattedtoCompare,  " DEVOIR <br> ", $combinedDateTimeExamFormattedtoCompare, "EXAM <br> ENNNND LINE <br><br><br>";


                    if ($row['type_eval'] == 1) {
                        if ($combinedDateTimeExamFormattedtoCompare > $now) {
                ?>

                            <!-- one eval  type devoir -->
                            <div class="one-eval">



                                <div class="left-info-eval">
                                    <a class="title-eval" href="#">
                                        <h2>

                                            <?php if ($row['type_eval'] == 1) : ?>
                                                <span>Examen:</span>
                                            <?php elseif ($row['type_eval'] == 2) : ?>
                                                <span>Devoir:</span>
                                            <?php endif; ?>

                                            <?= $row['title_eval'] ?? ''   ?>
                                        </h2>
                                    </a>

                                    <a href="#"> <?= $row['nom_matiere'] ?? ''   ?>
                                    </a>

                                    <?php
                                    $requete2 = "SELECT * FROM user WHERE id_user = {$row['ext_prof']} ";
                                    $stmt = $db->query($requete2);
                                    $prof = $stmt->fetch(PDO::FETCH_ASSOC);
                                    ?>


                                    <a href=""><?= $prof['user_prenom'] ?? '' ?> <?= $prof['user_nom'] ?? '' ?> </a>
                                </div>

                                <div class="right-info-eval">

                                    <!-- exam = take date and time from the cours during which we have exam-->
                                    <?php if ($row['type_eval'] == 1) : ?>
                                        <p class="date-eval"><?= $formattedDate ?? '' ?></p>
                                        <p><?= $formattedTime ?? '' ?></p>
                                        <p>Salle: <?= " " . $row['cours_salle'] ?? '' ?></p>

                                        <!-- devoir = not connected to courses date and time -->
                                    <?php elseif ($row['type_eval'] == 2) : ?>
                                        <p class="date-eval"><?= $dateDevoire ?? '' ?></p>
                                        <p>jusqu'à <?= ' ' . $timeDevoir ?? '' ?></p>
                                        <button class="deposer">Deposer le travail</button>
                                    <?php endif; ?>



                                </div>
                            </div>

                            <!-- one eval end-->






                <?php   };
                    };
                };
                ?>


                <!-- dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd -->










            </div>


        </div>

        <div id="past">
            <h1>Evaluations passées</h1>

            <div class="wrapper-past wrapper">
                <?php





                if ($combinedDateTimeExamFormattedtoCompare < $now  || $devoirFormattedtoCompare < $now) {



                ?>

                    <!-- one eval  type noted -->
                    <div class="one-eval">

                        <div class="left-info-eval">
                            <a class="title-eval" href="#">
                                <h2>

                                    <?php if ($row['type_eval'] == 1) : ?>
                                        <span>Examen:</span>
                                    <?php elseif ($row['type_eval'] == 2) : ?>
                                        <span>Devoir:</span>
                                    <?php endif; ?>

                                    <?= $row['title_eval'] ?? ''   ?>
                                </h2>
                            </a>

                            <a href="#"> <?= $row['nom_matiere'] ?? ''   ?>
                            </a>

                            <?php
                            $requete2 = "SELECT * FROM user WHERE id_user = {$row['ext_prof']} ";
                            $stmt = $db->query($requete2);
                            $prof = $stmt->fetch(PDO::FETCH_ASSOC);
                            ?>


                            <a href=""><?= $prof['user_prenom'] ?? '' ?> <?= $prof['user_nom'] ?? '' ?> </a>
                        </div>



                        <div class="right-info-eval">
                            <p class="date-eval"><?= ' ' . $formattedDate ?? '' ?></p>
                            <p class="note">Note: <span><?= " " . $row['note'] . ' / 20' ?? 'pas evalué' ?> </span></p>
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