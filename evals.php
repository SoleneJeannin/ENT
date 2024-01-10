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
    <title>Évaluations</title>


    <style>

 
            h1 {
                font-family: 'Lusitana', serif;
                margin-left: 4vw;
            }

         


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
    
            @media (max-width:900px) {
                .wrapper {
                    width: 100%;
                }

                .one-eval {
                    width: 96%;
                    margin: 5px auto;
                }
            }


    </style>

</head>

<body>

    <main>


        <?php

        include('nav.php');

        ?>



        <div id="future">

            <h1>Evaluations prochaines</h1>
            <div class="wrapper-future wrapper">


                <!-- dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd -->

                <?php
              
                 $sessionGroup = $_SESSION['groupe_user'];
                $requete = "

                SELECT
                title_projet,
                eval_date_fin,
                eval_date_debut,
                nom_matiere,
                coefficient,
               programme,
               
               NULL AS groupe,
                NULL AS salle,
                matiere.ext_prof AS prof_id,
                
                user_prof.user_nom AS prof_nom,
                user_prof.user_prenom AS prof_prenom,
                type,
              id_eval_projet AS id_eval
            FROM
                eval_projet
            JOIN matiere ON eval_projet.ext_matiere = matiere.id_matiere
            
            JOIN user AS user_prof ON matiere.ext_prof = user_prof.id_user
            WHERE programme = :sessionProgramme AND
                eval_projet.eval_date_fin > NOW() 
        
            UNION
            SELECT
                title_exam,
                cours_temps_fin,
                cours_temps_debut,
                nom_matiere,
                coefficient,
                programme,
                groupe,
                cours_salle,
               
              
                matiere.ext_prof AS prof_id,
                
                user_prof.user_nom AS prof_nom,
                user_prof.user_prenom AS prof_prenom,
                type,
                id_eval_exam AS id_eval
            FROM
                eval_exam
            JOIN cours ON cours.id_cours = eval_exam.ext_cours
            JOIN matiere ON matiere.id_matiere = cours.ext_matiere
      
            JOIN user AS user_prof ON matiere.ext_prof = user_prof.id_user
            WHERE programme = :sessionProgramme AND   
                cours.cours_temps_fin > NOW()";

 if ($sessionGroup === 'C') {
                    $requete .= " AND cours.groupe IN ('C', 'CD', 'M')";
                } elseif ($sessionGroup === 'A') {
                    $requete .= " AND cours.groupe IN ('A', 'AB', 'M')";
                } elseif ($sessionGroup === 'B') {
                    $requete .= " AND cours.groupe IN ('B', 'AB', 'M')";
                } elseif ($sessionGroup === 'D') {
                    $requete .= " AND cours.groupe IN ('D', 'CD', 'M')";
                }
                $stmt = $db->prepare($requete);

                // Bind the parameters
                $stmt->bindParam(':sessionProgramme', $_SESSION['programme_user'], PDO::PARAM_STR);
                // echo $requete;
                $stmt->execute();
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
                            <h2>


                                <?php if ($row['type'] == 1) : ?>
                                    <a class="title-eval" href="./examen.php?id=<?= $row['id_eval'] ?>">
                                    <?php elseif ($row['type'] == 2) : ?>
                                        <a class="title-eval" href="./projet.php?id=<?= $row['id_eval'] ?>">
                                        <?php endif; ?>

                                        <span><?php if ($row['type'] == 1) : ?>Examen:<?php elseif ($row['type'] == 2) : ?>Projet:<?php endif; ?></span>
                                        <?= $row['title_projet'] ?? '' ?>
                                        </a>
                            </h2>

                            <a href="#"> <?= $row['nom_matiere'] ?? '' ?></a>
                            <a href=""> <?= $row['prof_prenom'] . ' ' . $row['prof_nom'] ?? '' ?></a>
                        </div>


                        <?php if ($row['type'] == 1) : ?>


                            <div class="right-info-eval">
                                <p class="date-eval"><?= $deadlineDateFormatted ?? '' ?></p>
                                <p> <?= $startTime . " - " . $deadlineTimeFormatted ?? '' ?></p>
                                <p class="deposer">Salle <?= $row['salle'] ?? '' ?></p>
                            </div>



                        <?php elseif ($row['type'] == 2) : ?>

                            <div class="right-info-eval">
                                <p class="date-eval"><?= $deadlineDateFormatted ?? '' ?></p>
                                <p>jusqu'à <?= $deadlineTimeFormatted ?? '' ?></p>
                                <!-- <button class="deposer">Deposer le travail</button> -->
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
               
                $sessionGroup = $_SESSION['groupe_user'];

                $requete2 = " 
 
                SELECT
                title_projet,
                eval_date_fin,
                eval_date_debut,
                nom_matiere,
                coefficient,
               programme,
               
               NULL AS groupe,
                NULL AS salle,
                matiere.ext_prof AS prof_id,
                
                user_prof.user_nom AS prof_nom,
                user_prof.user_prenom AS prof_prenom,
                type,
              id_eval_projet AS id_eval
            FROM
                eval_projet
            JOIN matiere ON eval_projet.ext_matiere = matiere.id_matiere
            
            JOIN user AS user_prof ON matiere.ext_prof = user_prof.id_user
            WHERE programme = :sessionProgramme AND
                eval_projet.eval_date_fin < NOW() 
        
            UNION
            SELECT
                title_exam,
                cours_temps_fin,
                cours_temps_debut,
                nom_matiere,
                coefficient,
                programme,
                groupe,
                cours_salle,
               
              
                matiere.ext_prof AS prof_id,
                
                user_prof.user_nom AS prof_nom,
                user_prof.user_prenom AS prof_prenom,
                type,
                id_eval_exam AS id_eval
            FROM
                eval_exam
            JOIN cours ON cours.id_cours = eval_exam.ext_cours
            JOIN matiere ON matiere.id_matiere = cours.ext_matiere
      
            JOIN user AS user_prof ON matiere.ext_prof = user_prof.id_user
            WHERE programme = :sessionProgramme AND   
                cours.cours_temps_fin < NOW()";

                if ($sessionGroup === 'C') {
                    $requete2 .= " AND cours.groupe IN ('C', 'CD', 'M')";
                } elseif ($sessionGroup === 'A') {
                    $requete2 .= " AND cours.groupe IN ('A', 'AB', 'M')";
                } elseif ($sessionGroup === 'B') {
                    $requete2 .= " AND cours.groupe IN ('B', 'AB', 'M')";
                } elseif ($sessionGroup === 'D') {
                    $requete2 .= " AND cours.groupe IN ('D', 'CD', 'M')";
                }
                $stmt2 = $db->prepare($requete2);
// echo $requete2;
                // Bind the parameters
                $stmt2->bindParam(':sessionProgramme', $_SESSION['programme_user'], PDO::PARAM_STR);
                
                $stmt2->execute();

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
                        <h2>


<?php if ($row2['type'] == 1) : ?>
    <a class="title-eval" href="./examen.php?id=<?= $row2['id_eval'] ?>">
    <?php elseif ($row2['type'] == 2) : ?>
        <a class="title-eval" href="./projet.php?id=<?= $row2['id_eval'] ?>">
        <?php endif; ?>

        <span><?php if ($row2['type'] == 1) : ?>Examen:<?php elseif ($row2['type'] == 2) : ?>Projet:<?php endif; ?></span>
        <?= $row2['title_projet'] ?? '' ?>
        </a>
</h2>
                            <a href="#"> <?= $row2['nom_matiere'] ?? '' ?></a>
                            <a href=""> <?= $row2['prof_prenom'] . ' ' . $row2['prof_nom'] ?? '' ?></a>
                        </div>



                      
            

            

                        <div class="right-info-eval">
                            <p class="date-eval"><?= $deadlineDateFormatted ?? '' ?></p>
                            <p class="note">Note: <span>
                                
                            
                            <?php
                      if ($row2['type'] == 1) {
                        $requete3 = "SELECT * FROM `note_exam` WHERE ext_eval_exam = {$row2['id_eval']}";
                        $stmt3 = $db->query($requete3);
                        $evals3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                    }
                    if ($row2['type'] == 2) {
                        $requete3 = "SELECT * FROM `note_projet` WHERE ext_projet = {$row2['id_eval']}";
                        $stmt3 = $db->query($requete3);
                        $evals3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                    }


                    echo " " . ($evals3['note_projet'] ?? 'pas evalué') . ' / 20';
                    ?>
                            
                              </span></p>
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