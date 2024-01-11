<?php
include('connexion.php');
session_start();
?>
<?php if (isset($_SESSION["login"]) && ($_SESSION["role"]) == 1) { ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&family=Lusitana:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_de_base.css">
    <title>ENT - Université Gustave Eiffel</title>

    <style>
        .big-wrapper {
            display: flex;
            height: 90%;
            align-items: stretch;

        }

        @media (max-width: 1600px) {


            .big-wrapper {
                flex-wrap: wrap-reverse;
                height: fit-content !important;
            }

            .line2 {
                flex-direction: row-reverse !important;
                width: 95% !important;
                margin: 30px auto !important;
            }

            .cube2 {
                height: 700px !important;
            }

            .line {
                flex-direction: row-reverse;

                width: 95% !important;
                margin: 30px auto !important;
            }

            .edt {
                width: 80% !important;
            }

            .access {
                height: 8vw !important;

            }

            .search-bar {
                height: 20% !important;
            }

        }



        @media (max-width: 1000px) {


            .line {
                flex-direction: column-reverse;
            }

            .edt {
                margin: auto;
            }

        }



        @media (max-width: 900px) {


            .line2 {
                flex-direction: column !important;
                height: 800px;
            }

            .cube2 {
                height: 300px !important;
            }

            #search {
                width: 70% !important;
            }

            #search-button {
                background-color: var(--red) !important;
            }

            .search-bar {
                height: 70% !important;
            }

            .fast-access {
                width: 100% !important;
            }

            .access {
                height: 15vw !important;
            }

            .notifs {
                height: 70% !important;
                margin-top: 70px;
            }

            .evals {
                margin-top: 50px;
            }

            .block-wrapper-evals {

                height: 80% !important;
            }

            .evals1 {
                height: 95% !important;
            }

            .evals2 {
                height: 25% !important;
                margin-bottom: 100px;
            }

        }

        .line {

            width: 140%;
            display: flex;

        }

        .line2 {

            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: stretch;


        }

        .evals {
            width: 100%;
        }

        .edt {
            padding: 20px;
            width: 100%;
        }

        .cube {}

        .cube2 {
            width: 100%;
            height: 45%;

        }

        .cube3 {
            width: 100%;
            height: 55%;

        }


        .schedule {

            display: grid;
            grid-gap: 0.1rem;
            grid-template-rows:
                [tracks] 1em [time-0800] 1fr [time-0815] 1fr [time-0830] 1fr [time-0845] 1fr [time-0900] 1fr [time-0915] 1fr [time-0930] 1fr [time-0945] 1fr [time-1000] 1fr [time-1015] 1fr [time-1030] 1fr [time-1045] 1fr [time-1100] 1fr [time-1115] 1fr [time-1130] 1fr [time-1145] 1fr [time-1200] 1fr [time-1215] 1fr [time-1230] 1fr [time-1245] 1fr [time-1300] 1fr [time-1315] 1fr [time-1330] 1fr [time-1345] 1fr [time-1400] 1fr [time-1415] 1fr [time-1430] 1fr [time-1445] 1fr [time-1500] 1fr [time-1515] 1fr [time-1530] 1fr [time-1545] 1fr [time-1600] 1fr [time-1615] 1fr [time-1630] 1fr [time-1645] 1fr [time-1700] 1fr [time-1715] 1fr [time-1730] 1fr [time-1745] 1fr [time-1800] 1fr;


            grid-template-columns:
                [times] 4em [Mon-start] 1fr [Mon-end];
        }

        .session {
            padding: .5em;
            border-radius: 5px;
            font-size: 14px;

        }

        .session-title,
        .session-time,
        .session-track,
        .session-presenter {
            display: block;
        }

        .session-title,
        .time-slot {
            margin: 0;
            font-size: 1em;
        }

        .session-title a {
            color: black;
            text-decoration-style: dotted;

            &:hover {
                font-style: italic;
            }

            &:focus {
                outline: 2px dotted rgba(255, 255, 255, .8);
            }
        }

        .track-slot,
        .time-slot {
            font-weight: bold;
            font-size: .75em;
        }

        .track-all {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ccc;
            color: #000;
            box-shadow: none;
        }

        .text {
            max-width: 750px;
            font-size: 18px;
            margin: 0 auto 50px;
        }

        .meta {
            color: #555;
            font-style: italic;
        }

        .meta a {
            color: #555;
        }

        hr {
            margin: 40px 0;
        }



        .evals1 {
            height: 73%;

        }

        .block-wrapper-evals {
            background-color: var(--grey);
            width: 90%;
            margin: auto;
            height: 85%;
            border-radius: 15px;
            position: relative;
            padding-block: 8px;
            overflow-y: auto;
            max-height: 600px;
        }

        .one-eval {
            background-color: white;
            margin: 10px 20px;
            display: flex;
            padding: 15px 30px;
            border-radius: 15px;
            justify-content: space-between;
        }

        .one-eval p {
            padding-left: 20px;
        }

        .right-info {
            text-align: right;

        }



        .one-eval h3,
        .one-eval p {
            margin: 0;
        }

        .evals1>h2 {
            padding-left: 20px;
            font-size: 1.8rem;
            padding-left: 31px;
            margin-bottom: 15px;
            margin-top: 30px;
        }

        .evals2 {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 15%;
        }

        .evals2 h2 {
            font-size: 1.8rem;
            text-align: center;
            margin: 5px 30px;


        }

        .evals2 p {
            font-size: 1.5rem;
            text-align: center;
            margin: 0;
            font-weight: 200;
        }


        .search-bar {
            height: 50%;
            position: relative;

        }

        #search-form {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        #search-button {
            border: none;
            background-color: var(--yellow4);
            padding: 13px 20px;
            border-radius: 10px;
            margin-left: 10px;
        }

        #search {
            width: 60%;
            height: 25%;
            border: 0;
            border-radius: 10px;
            background-color: var(--yellow1);

        }



        .fast-access {
            display: flex;
            justify-content: space-evenly;
            width: 85%;
            margin: auto;
        }

        .access {
            background-color: var(--yellow2);
            height: 6vw;
            aspect-ratio: 1;
            border-radius: 5px;
        }

        #fill,
        #fill2 {
            stroke: var(--yellow4);
        }


        .wrapper-notifications {
            width: 90%;
            margin: auto;
            height: 300px;
            background-color: var(--grey);
            border-radius: 15px;
            padding: 15px;
            overflow-y: scroll;
        }

        .one-notif {
            background-color: white;
            display: flex;
            justify-content: space-between;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .time-notif p {
            margin: 0;
            text-align: right;
            font-size: 0.8rem;
        }

        .text-notif p {
            margin: 0;
            width: 90%;
        }

        .notifs>h2 {
            font-size: 1.8rem;
            padding-left: 35px;
        }


        .left-info {
            max-width: 50%;
        }

        .info-wrapper-eval {
            display: flex;
            justify-content: space-between;
        }

        .title-eval {
            display: block;
            width: 100%;
        }

        .one-eval a {
            color: #000;
        }

        .one-eval h3 {
            font-size: 1rem;
        }

        .one-eval p {
            font-size: 0.9rem;
        }


        .non-visible {
            display: none;
        }

        .access {
            position: relative;
        }

        .button-save {
            background-color: var(--yellow4);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: auto;
            margin-left: 35px;
            margin-block: 15px;

        }

        .list {
            margin: auto;
            width: 170px;
            padding-block: 20px;
        }

        .list {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 170px;
        }

        .fast-access {
            position: relative;
        }

        .choose-fast {
            position: absolute;
            top: 10%;
            width: 210px;
            height: 330px;
            border-radius: 10px;
            background-color: var(--yellow1);
            z-index: 10;
            top: 100px;
            left: -50px;
        }

        .open {
            position: absolute;
            top: 7px;
            right: 5px;
            width: 20px;
            cursor: pointer;
        }

        


   
                            .link-fast>svg {
                                cursor: pointer;
                            }

                            .link-fast {
                                display: grid;
                                place-items: center;
                                height: 100%;
                            }

                            .link-fast>img {
                                width: 50%;
                                height: 50%;

                            }
                      
    </style>
</head>

<body>

    <main>


        <?php

if (isset($_SESSION["login"])) {
        include('nav.php');


        ?>

        <div class="big-wrapper">
            <div class="top line">



                <div class="evals cube">

                    <div class="evals1">
                        <h2>Evaluations prochaines</h2>
                        <div class="block-wrapper-evals">




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

                id_matiere,
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
                id_matiere,
              
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


                                setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

                                //format date and time
                                $deadlineDate = new DateTime($row['eval_date_fin']);
                                $deadlineDateFormatted = $deadlineDate->format('j F Y'); //day of exam or project

                                $deadlineTime = new DateTime($row['eval_date_debut']);
                                $deadlineTimeFormatted = $deadlineDate->format('H:i'); //last time for exam and project

                                $startDate = new DateTime($row['eval_date_debut']);
                                $startTime = $startDate->format('H:i'); // start of exam
                            ?>




                                <!-- one eval -->
                                <div class="one-eval">


                                    <?php if ($row['type'] == 1) : ?>

                                        <a class="title-eval" href="./examen.php?id=<?= $row['id_eval'] ?>">

                                            <h3>Examen: <?= $row['title_projet'] ?? '' ?></h3>

                                            <div class="info-wrapper-eval">
                                                <div class="left-info">

                                                    <p><?= $row['nom_matiere'] ?? '' ?></p>
                                                    <p><?= $row['prof_prenom'] . ' ' . $row['prof_nom'] ?? '' ?></p>
                                                </div>
                                                <div class="right-info">
                                                    <p><?= $deadlineDateFormatted ?? '' ?></p>
                                                    <p><?= $startTime . " - " . $deadlineTimeFormatted ?? '' ?></p>
                                                    <p>Salle <?= $row['salle'] ?? '' ?></p>
                                                </div>
                                            </div>
                                        </a>




                                    <?php elseif ($row['type'] == 2) : ?>

                                        <a class="title-eval" href="./projet.php?id=<?= $row['id_eval'] ?>">
                                            <h3>Projet: <?= $row['title_projet'] ?? '' ?></h3>

                                            <div class="info-wrapper-eval">
                                                <div class="left-info">

                                                    <p><?= $row['nom_matiere'] ?? '' ?></p>
                                                    <p><?= $row['prof_prenom'] . ' ' . $row['prof_nom'] ?? '' ?></p>
                                                </div>
                                                <div class="right-info">
                                                    <p><?= $deadlineDateFormatted ?? '' ?></p>
                                                    <p>jusqu'à <?= $deadlineTimeFormatted ?? '' ?></p>
                                                </div>
                                            </div>

                                        </a>
                                    <?php endif; ?>



                                </div>

                            <?php }; ?>






                        </div>
                    </div>

                    <div class="evals2">
                        <div class="retards">
                            <h2>Retards</h2>
                            <p><?php if ($result["user_retard"] !== NULL) {
                                echo $result['user_retard'];

                            } else {
                                echo 0;
                            } ?>
                            minutes</p>
                        </div>
                        <div class="abscents">
                            <h2>Absences</h2>
                            <p><?= $abs_non_justif ?> heures</p>
                        </div>
                    </div>



                </div>




                <div class="edt cube">

                    <?php
                    
                    $sessionGroup = $_SESSION['groupe_user'];
                   

                    $requete = "
        SELECT cours_temps_debut, cours_temps_fin, cours_salle, ext_matiere, groupe, programme, couleur, nom_matiere, ext_prof, user_nom, user_prenom, exam
        FROM cours
        LEFT JOIN matiere ON cours.ext_matiere = matiere.id_matiere
        LEFT JOIN user ON matiere.ext_prof = user.id_user
        WHERE programme = :prog AND DATE(cours_temps_debut) = CURDATE()";

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
                    $stmt->bindValue(':prog',  $_SESSION['programme_user'], PDO::PARAM_STR);
                    $stmt->execute();
                    $allcourses = $stmt->fetchAll(PDO::FETCH_ASSOC);
                   


                    ?>



                    <div class="schedule">

                        <span class="track-slot" aria-hidden="true" style="grid-column: Mon; grid-row: tracks;">
                            <?php

                            $todayDate = strftime('%d %B %Y');
                            echo "$todayDate";
                            ?>
                        </span>


                        <h2 class="time-slot" style="grid-row: time-0800;">08:00</h2>
                        <!-- <h2 class="time-slot" style="grid-row: time-0815;">08:15</h2>
                <h2 class="time-slot" style="grid-row: time-0830;">08:30</h2>
                <h2 class="time-slot" style="grid-row: time-0845;">08:45</h2> -->
                        <h2 class="time-slot" style="grid-row: time-0900;">09:00</h2>
                        <!-- <h2 class="time-slot" style="grid-row: time-0915;">09:15</h2>
                <h2 class="time-slot" style="grid-row: time-0930;">09:30</h2>
                <h2 class="time-slot" style="grid-row: time-0945;">09:45</h2> -->
                        <h2 class="time-slot" style="grid-row: time-1000;">10:00</h2>
                        <!-- <h2 class="time-slot" style="grid-row: time-1015;">10:15</h2>
                <h2 class="time-slot" style="grid-row: time-1030;">10:30</h2>
                <h2 class="time-slot" style="grid-row: time-1045;">10:45</h2> -->
                        <h2 class="time-slot" style="grid-row: time-1100;">11:00</h2>
                        <!-- <h2 class="time-slot" style="grid-row: time-1115;">11:15</h2>
                <h2 class="time-slot" style="grid-row: time-1130;">11:30</h2>
                <h2 class="time-slot" style="grid-row: time-1145;">11:45</h2> -->
                        <h2 class="time-slot" style="grid-row: time-1200;">12:00</h2>
                        <!-- <h2 class="time-slot" style="grid-row: time-1215;">12:15</h2>
                <h2 class="time-slot" style="grid-row: time-1230;">12:30</h2>
                <h2 class="time-slot" style="grid-row: time-1245;">12:45</h2> -->
                        <h2 class="time-slot" style="grid-row: time-1300;">13:00</h2>
                        <!-- <h2 class="time-slot" style="grid-row: time-1315;">13:15</h2>
                <h2 class="time-slot" style="grid-row: time-1330;">13:30</h2>
                <h2 class="time-slot" style="grid-row: time-1345;">13:45</h2> -->
                        <h2 class="time-slot" style="grid-row: time-1400;">14:00</h2>
                        <!-- <h2 class="time-slot" style="grid-row: time-1415;">14:15</h2>
                <h2 class="time-slot" style="grid-row: time-1430;">14:30</h2>
                <h2 class="time-slot" style="grid-row: time-1445;">14:45</h2> -->
                        <h2 class="time-slot" style="grid-row: time-1500;">15:00</h2>
                        <!-- <h2 class="time-slot" style="grid-row: time-1515;">15:15</h2>
                <h2 class="time-slot" style="grid-row: time-1530;">15:30</h2>
                <h2 class="time-slot" style="grid-row: time-1545;">15:45</h2> -->
                        <h2 class="time-slot" style="grid-row: time-1600;">16:00</h2>
                        <!-- <h2 class="time-slot" style="grid-row: time-1615;">16:15</h2>
                <h2 class="time-slot" style="grid-row: time-1630;">16:30</h2>
                <h2 class="time-slot" style="grid-row: time-1645;">16:45</h2> -->
                        <h2 class="time-slot" style="grid-row: time-1700;">17:00</h2>
                        <!-- <h2 class="time-slot" style="grid-row: time-1715;">17:15</h2>
                <h2 class="time-slot" style="grid-row: time-1730;">17:30</h2>
                <h2 class="time-slot" style="grid-row: time-1745;">17:45</h2> -->
                        <h2 class="time-slot" style="grid-row: time-1800;">18:00</h2>



                        <?php
                        //  var_dump($allcourses) ;
                        foreach ($allcourses as $cours) {
                            

                            $dateTimeStart = new DateTime($cours['cours_temps_debut']);
                            $dateTimeFinish = new DateTime($cours['cours_temps_fin']);

                            $dayOfWeek = $dateTimeStart->format('D');
                            $timeStart = $dateTimeStart->format('Hi');
                            $timeFinish = $dateTimeFinish->format('Hi');

                            $timeStartVisual = $dateTimeStart->format('H:i');
                            $timeFinishVisual = $dateTimeFinish->format('H:i');
                        ?>

                            <div class="session session-1" style="grid-column: Mon
; grid-row: time-<?= $timeStart ?> / time-<?= $timeFinish ?>; background-color: <?= $cours['couleur'] ?>; color: black;">
                                <?php
                                if ($cours['exam'] !== null) {
                                    echo "<h4 style='color: var(--red);' class='session-title'>Examen</h4>";
                                }
                                ?>
                                <h3 class="session-title"><a href="#"><?= $cours['nom_matiere'] ?></a></h3>
                                <span class="session-time"><?= $timeStartVisual ?> - <?= $timeFinishVisual ?></span>
                                <span class="session-group">
                                    <?php
                                    $group = $cours['groupe'];

                                    // Check conditions and format group name accordingly
                                    switch ($group) {
                                        case 'A':
                                        case 'B':
                                        case 'C':
                                        case 'D':
                                            $formattedGroup = "TP " . $group;
                                            break;

                                        case 'AB':
                                        case 'CD':
                                            $formattedGroup = "TD " . $group;
                                            break;

                                        case 'M':
                                            $formattedGroup = 'CM';
                                            break;

                                        default:
                                            $formattedGroup = $group;
                                    }
                                    echo $formattedGroup;
                                    ?>


                                </span>
                                <span class="session-teacher"> <?= $cours['user_prenom'] . " " . $cours['user_nom'] ?></span>
                                <span class="session-room">Salle <?= $cours['cours_salle'] ?></span>
                            </div>

                        <?php } ?>






                    </div>
                </div>
            </div>
            <div class="bottom line2">
                <div class=" cube2">

                    <div class="search-bar">
                        <form id="search-form" action="">
                            <input type="text" name="search" id="search">
                            <button type="submit" id="search-button">Trouver</button>
                        </form>
                    </div>




                    <div class="fast-access">

                        <?php
                        $requete1 = "SELECT *
                        FROM user
                        JOIN fastaccess ON user.user_acces_rapide1 = fastaccess.id_fast
                        WHERE user.id_user = :id";

                        $stmt1 = $db->prepare($requete1);
                        $stmt1->bindValue(':id', $_SESSION['id_user'], PDO::PARAM_STR);
                        $stmt1->execute();
                        $access1 = $stmt1->fetch(PDO::FETCH_ASSOC);

                        ?>


                        <!-- access1 -->
                        <div class="access">

                            <?php
                            if ($access1 && $access1['user_acces_rapide1'] !== 0) {
                                echo '  <div class="open open1" >                    
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 16 16" fill="var(--yellow4)" class="bi bi-three-dots-vertical">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    <path xmlns="http://www.w3.org/2000/svg" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    </svg>
                                </div>';
                                if ($access1['user_acces_rapide1'] == 1) {
                                    $link = 'https://cpanel.' . $access1['user_nom'] . '.butmmi.o2switch.site/';
                                } else {
                                    $link = $access1['link_fast'];
                                }
                                
                                                                echo '<a class="link-fast" href="' . $link . '"><img src="./fact_access/' . $access1['img_fast'] . '" alt=""></a>';
                                                         
                            } else {
                                echo '<div class="link-fast">
                                    <svg class="open1" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none">
                                        <path id="fill2" d="M12 8.327V15.654" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path id="fill" d="M15.667 11.99H8.33301" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>';
                            }
                            ?>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var points1 = document.querySelector(".open1");
                                    var list1 = document.querySelector(".choosen1");

                                    if (points1 && list1) {
                                        points1.addEventListener('click', function() {
                                            list1.classList.toggle('non-visible');
                                        });
                                    }




                                    var points2 = document.querySelector(".open2");
                                    var list2 = document.querySelector(".choosen2");

                                    if (points2 && list2) {
                                        points2.addEventListener('click', function() {
                                            list2.classList.toggle('non-visible');
                                        });
                                    }


                                    var points3 = document.querySelector(".open3");
                                    var list3 = document.querySelector(".choosen3");

                                    if (points3 && list3) {
                                        points3.addEventListener('click', function() {
                                            list3.classList.toggle('non-visible');
                                        });
                                    }

                                    var points4 = document.querySelector(".open4");
                                    var list4 = document.querySelector(".choosen4");

                                    if (points4 && list4) {
                                        points4.addEventListener('click', function() {
                                            list4.classList.toggle('non-visible');
                                        });
                                    }


                                });
                            </script>


                            <div class="choose-fast choosen1 non-visible">
                                <div class="list">
                                    <form class="list" action="save_fastaccess.php?id=1" method="post">
                                        <?php
                                        $query11 = "SELECT * FROM fastaccess, user
                                             WHERE user.id_user = :userId";
                                        $stmt11 = $db->prepare($query11);
                                        $stmt11->bindParam(':userId', $_SESSION['id_user'], PDO::PARAM_INT);
                                        $stmt11->execute();
                                        $fastAccessList = $stmt11->fetchAll(PDO::FETCH_ASSOC);
                                        // var_dump($fastAccessList);


                                        echo '';
                                        foreach ($fastAccessList as $access) {
                                            $id = $access['id_fast'];
                                            $label = $access['name_fast'];

                                            $isChecked = ($access['id_fast'] == $access['user_acces_rapide1']) ? 'checked' : '';

                                            // $isChecked = ($access['user_acces_rapide1'] == $id || $access['user_acces_rapide2'] == $id || $access['user_acces_rapide3'] == $id || $access['user_acces_rapide4'] == $id) ? 'checked' : '';
                                            echo '<label>';
                                            echo "<input type='radio' name='fastAccess' value='$id' $isChecked  >";
                                            echo "$label";
                                            echo '</label>';
                                        }

                                        echo '<label>';
                                        echo "<input type='radio' name='fastAccess' value='0' >";
                                        echo "rien";
                                        echo '</label>';
 

                                        ?>
                                         
                                        <input type="submit" class="button-save" value="Sauvgarder">
                                    </form>
                                </div>
                            </div>




                        </div>












                        <!-- access2   -->


                        <?php
                        $requete2 = "SELECT *
                        FROM user
                        JOIN fastaccess ON user.user_acces_rapide2 = fastaccess.id_fast
                        WHERE user.id_user = :id";

                        $stmt2 = $db->prepare($requete2);
                        $stmt2->bindValue(':id', $_SESSION['id_user'], PDO::PARAM_STR);
                        $stmt2->execute();
                        $access2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                        ?>



                        <div class="access">



                            <?php
                            if ($access2 && $access2['user_acces_rapide2'] !== 0) {
                                echo '  <div class="open open2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 16 16" fill="var(--yellow4)" class="bi bi-three-dots-vertical">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    <path xmlns="http://www.w3.org/2000/svg" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    </svg>
                                </div>';

                                if ($access2['user_acces_rapide2'] == 1) {
                                    $link = 'https://cpanel.' . $access2['user_nom'] . '.butmmi.o2switch.site/';
                                } else {
                                    $link = $access2['link_fast'];
                                }
                                
                                                                echo '<a class="link-fast" href="' . $link . '"><img src="./fact_access/' . $access2['img_fast'] . '" alt=""></a>';
                                                         


                              
                            } else {
                                echo '<div class="link-fast">
                                <svg class="open2" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none">
                                    <path id="fill2" d="M12 8.327V15.654" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path id="fill" d="M15.667 11.99H8.33301" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>';
                            }
                            ?>


                            <div class="choose-fast choosen2 non-visible">
                                <div class="list">
                                    <form class="list" action="save_fastaccess.php?id=2" method="post">
                                        <?php
                                        $query11 = "SELECT * FROM fastaccess, user
                                             WHERE user.id_user = :userId";
                                        $stmt11 = $db->prepare($query11);
                                        $stmt11->bindParam(':userId', $_SESSION['id_user'], PDO::PARAM_INT);
                                        $stmt11->execute();
                                        $fastAccessList = $stmt11->fetchAll(PDO::FETCH_ASSOC);
                                        // var_dump($fastAccessList);
                                        $first = 1;

                                        echo '';
                                        foreach ($fastAccessList as $access) {
                                            $id = $access['id_fast'];
                                            $label = $access['name_fast'];

                                            $isChecked = ($access['id_fast'] == $access['user_acces_rapide2']) ? 'checked' : '';

                                            // $isChecked = ($access['user_acces_rapide1'] == $id || $access['user_acces_rapide2'] == $id || $access['user_acces_rapide3'] == $id || $access['user_acces_rapide4'] == $id) ? 'checked' : '';
                                            echo '<label>';
                                            echo "<input type='radio' name='fastAccess' value='$id' $isChecked  >";
                                            echo "$label";
                                            echo '</label>';
                                        }

                                        echo '<label>';
                                        echo "<input type='radio' name='fastAccess' value='0' >";
                                        echo "rien";
                                        echo '</label>';

                                      

                                        ?>
                                        <input type="submit" class="button-save" value="Sauvgarder">
                                    </form>
                                </div>
                            </div>
                        </div>








                        <!-- access3   -->


                        <?php
                        $requete3 = "SELECT *
                        FROM user
                        JOIN fastaccess ON user.user_acces_rapide3 = fastaccess.id_fast
                        WHERE user.id_user = :id";

                        $stmt3 = $db->prepare($requete3);
                        $stmt3->bindValue(':id', $_SESSION['id_user'], PDO::PARAM_STR);
                        $stmt3->execute();
                        $access3 = $stmt3->fetch(PDO::FETCH_ASSOC);

                        ?>



                        <div class="access">

                            <?php
                            if ($access3 && $access3['user_acces_rapide3'] !== 0) {
                                echo '  <div class="open open3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 16 16" fill="var(--yellow4)" class="bi bi-three-dots-vertical">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    <path xmlns="http://www.w3.org/2000/svg" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    </svg>
                                </div>';


                                if ($access3['user_acces_rapide3'] == 1) {
                                    $link = 'https://cpanel.' . $access3['user_nom'] . '.butmmi.o2switch.site/';
                                } else {
                                    $link = $access3['link_fast'];
                                }
                                
                                                                echo '<a class="link-fast" href="' . $link . '"><img src="./fact_access/' . $access3['img_fast'] . '" alt=""></a>';
                                                         



                                
                            } else {
                                echo '<div class="link-fast">
                                    <svg class="open3" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none">
                                        <path id="fill2" d="M12 8.327V15.654" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path id="fill" d="M15.667 11.99H8.33301" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>';
                            }
                            ?>


                            <div class="choose-fast choosen3 non-visible">
                                <div class="list">
                                    <form class="list" action="save_fastaccess.php?id=3" method="post">
                                        <?php
                                        $query11 = "SELECT * FROM fastaccess, user
                                             WHERE user.id_user = :userId";
                                        $stmt11 = $db->prepare($query11);
                                        $stmt11->bindParam(':userId', $_SESSION['id_user'], PDO::PARAM_INT);
                                        $stmt11->execute();
                                        $fastAccessList = $stmt11->fetchAll(PDO::FETCH_ASSOC);
                                        // var_dump($fastAccessList);
                                        $first = 1;

                                        echo '';
                                        foreach ($fastAccessList as $access) {
                                            $id = $access['id_fast'];
                                            $label = $access['name_fast'];

                                            $isChecked = ($access['id_fast'] == $access['user_acces_rapide3']) ? 'checked' : '';

                                            // $isChecked = ($access['user_acces_rapide1'] == $id || $access['user_acces_rapide2'] == $id || $access['user_acces_rapide3'] == $id || $access['user_acces_rapide4'] == $id) ? 'checked' : '';
                                            echo '<label>';
                                            echo "<input type='radio' name='fastAccess' value='$id' $isChecked  >";
                                            echo "$label";
                                            echo '</label>';
                                        }

                                        echo '<label>';
                                        echo "<input type='radio' name='fastAccess' value='0' >";
                                        echo "rien";
                                        echo '</label>';

                                        

                                        ?>
                                        <input type="submit" class="button-save" value="Sauvgarder">
                                    </form>
                                </div>
                            </div>
                        </div>



                        <!-- access   -->


                        <?php
                        $requete4 = "SELECT *
                        FROM user
                        JOIN fastaccess ON user.user_acces_rapide4 = fastaccess.id_fast
                        WHERE user.id_user = :id";

                        $stmt4 = $db->prepare($requete4);
                        $stmt4->bindValue(':id', $_SESSION['id_user'], PDO::PARAM_STR);
                        $stmt4->execute();
                        $access4 = $stmt4->fetch(PDO::FETCH_ASSOC);

                        ?>



                        <div class="access">

                            <?php
                            if ($access4 && $access4['user_acces_rapide2'] !== 0) {
                                echo '  <div class="open open4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 16 16" fill="var(--yellow4)" class="bi bi-three-dots-vertical">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    <path xmlns="http://www.w3.org/2000/svg" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    </svg>
                                </div>';

if ($access4['user_acces_rapide4'] == 1) {
    $link = 'https://cpanel.' . $access4['user_nom'] . '.butmmi.o2switch.site/';
} else {
    $link = $access4['link_fast'];
}

                                echo '<a class="link-fast" href="' . $link . '"><img src="./fact_access/' . $access4['img_fast'] . '" alt=""></a>';
                            } else {
                                echo '<div class="link-fast">
            <svg class="open4" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none">
                <path id="fill2" d="M12 8.327V15.654" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path id="fill" d="M15.667 11.99H8.33301" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>';
                            }
                            ?>

                            <div class="choose-fast choosen4 non-visible">
                                <div class="list">
                                    <form class="list" action="save_fastaccess.php?id=4" method="post">
                                        <?php
                                        $query11 = "SELECT * FROM fastaccess, user
                                             WHERE user.id_user = :userId";
                                        $stmt11 = $db->prepare($query11);
                                        $stmt11->bindParam(':userId', $_SESSION['id_user'], PDO::PARAM_INT);
                                        $stmt11->execute();
                                        $fastAccessList = $stmt11->fetchAll(PDO::FETCH_ASSOC);
                                        // var_dump($fastAccessList);
                                        $first = 1;

                                        echo '';
                                        foreach ($fastAccessList as $access) {
                                            $id = $access['id_fast'];
                                            $label = $access['name_fast'];

                                            $isChecked = ($access['id_fast'] == $access['user_acces_rapide4']) ? 'checked' : '';

                                            // $isChecked = ($access['user_acces_rapide1'] == $id || $access['user_acces_rapide2'] == $id || $access['user_acces_rapide3'] == $id || $access['user_acces_rapide4'] == $id) ? 'checked' : '';
                                            echo '<label>';
                                            echo "<input type='radio' name='fastAccess' value='$id' $isChecked  >";
                                            echo "$label";
                                            echo '</label>';
                                        }

                                        echo '<label>';
                                        echo "<input type='radio' name='fastAccess' value='0' >";
                                        echo "rien";
                                        echo '</label>';

                                      

                                        ?>
                                        <input type="submit" class="button-save" value="Sauvgarder">
                                    </form>
                                </div>
                            </div>

                        </div>














                    </div>















                    <div class="notifs cube3">
                        <h2>Notification</h2>
                        <div class="wrapper-notifications">


                            <div class="one-notif">
                                <div class="text-notif">
                                    <p>Florence Bister vient d'ajouter le bloc dans R2.2 Gestion d'Information</p>
                                </div>
                                <div class="time-notif">
                                    <p>12.12.2023</p>
                                    <p>23:10</p>
                                </div>
                            </div>

                            <div class="one-notif">
                                <div class="text-notif">
                                    <p>Florence Bister vient d'ajouter le bloc dans R2.2 Gestion d'Information</p>
                                </div>
                                <div class="time-notif">
                                    <p>12.12.2023</p>
                                    <p>23:10</p>
                                </div>
                            </div>

                            <div class="one-notif">
                                <div class="text-notif">
                                    <p>Florence Bister vient d'ajouter le bloc dans R2.2 Gestion d'Information</p>
                                </div>
                                <div class="time-notif">
                                    <p>12.12.2023</p>
                                    <p>23:10</p>
                                </div>
                            </div>


                            <div class="one-notif">
                                <div class="text-notif">
                                    <p>Florence Bister vient d'ajouter le bloc dans R2.2 Gestion d'Information</p>
                                </div>
                                <div class="time-notif">
                                    <p>12.12.2023</p>
                                    <p>23:10</p>
                                </div>
                            </div>


                            <div class="one-notif">
                                <div class="text-notif">
                                    <p>Florence Bister vient d'ajouter le bloc dans R2.2 Gestion d'Information</p>
                                </div>
                                <div class="time-notif">
                                    <p>12.12.2023</p>
                                    <p>23:10</p>
                                </div>
                            </div>


                            <div class="one-notif">
                                <div class="text-notif">
                                    <p>Florence Bister vient d'ajouter le bloc dans R2.2 Gestion d'Information</p>
                                </div>
                                <div class="time-notif">
                                    <p>12.12.2023</p>
                                    <p>23:10</p>
                                </div>
                            </div>
                            <div class="one-notif">
                                <div class="text-notif">
                                    <p>Florence Bister vient d'ajouter le bloc dans R2.2 Gestion d'Information</p>
                                </div>
                                <div class="time-notif">
                                    <p>12.12.2023</p>
                                    <p>23:10</p>
                                </div>
                            </div>
                            <div class="one-notif">
                                <div class="text-notif">
                                    <p>Florence Bister vient d'ajouter le bloc dans R2.2 Gestion d'Information</p>
                                </div>
                                <div class="time-notif">
                                    <p>12.12.2023</p>
                                    <p>23:10</p>
                                </div>
                            </div>
                            <div class="one-notif">
                                <div class="text-notif">
                                    <p>Florence Bister vient d'ajouter le bloc dans R2.2 Gestion d'Information</p>
                                </div>
                                <div class="time-notif">
                                    <p>12.12.2023</p>
                                    <p>23:10</p>
                                </div>
                            </div>
                            <div class="one-notif">
                                <div class="text-notif">
                                    <p>Florence Bister vient d'ajouter le bloc dans R2.2 Gestion d'Information</p>
                                </div>
                                <div class="time-notif">
                                    <p>12.12.2023</p>
                                    <p>23:10</p>
                                </div>
                            </div>
                            <div class="one-notif">
                                <div class="text-notif">
                                    <p>Florence Bister vient d'ajouter le bloc dans R2.2 Gestion d'Information</p>
                                </div>
                                <div class="time-notif">
                                    <p>12.12.2023</p>
                                    <p>23:10</p>
                                </div>
                            </div>



                        </div>



                    </div>
                </div>
            </div>


<?php }else{
    header("location:login.php?errConnexion");
    }?>

    </main>


</body>

</html>

<?php } else {
            header("location:login.php?errConnexion");
        } ?>