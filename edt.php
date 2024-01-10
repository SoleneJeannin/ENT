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
    <title>Emploi de temps</title>

    <style>
        /*************************
    * GRID SCHEDULE LAYOUT
    *************************/
        @media screen and (min-width:1px) {
            .schedule {
                display: grid;
                grid-gap: 0.1rem;
                grid-template-rows:
                    [tracks] auto [time-0800] 1fr [time-0815] 1fr [time-0830] 1fr [time-0845] 1fr [time-0900] 1fr [time-0915] 1fr [time-0930] 1fr [time-0945] 1fr [time-1000] 1fr [time-1015] 1fr [time-1030] 1fr [time-1045] 1fr [time-1100] 1fr [time-1115] 1fr [time-1130] 1fr [time-1145] 1fr [time-1200] 1fr [time-1215] 1fr [time-1230] 1fr [time-1245] 1fr [time-1300] 1fr [time-1315] 1fr [time-1330] 1fr [time-1345] 1fr [time-1400] 1fr [time-1415] 1fr [time-1430] 1fr [time-1445] 1fr [time-1500] 1fr [time-1515] 1fr [time-1530] 1fr [time-1545] 1fr [time-1600] 1fr [time-1615] 1fr [time-1630] 1fr [time-1645] 1fr [time-1700] 1fr [time-1715] 1fr [time-1730] 1fr [time-1745] 1fr [time-1800] 1fr;
                

                grid-template-columns:
                    [times] 4em [Mon-start] 1fr [Mon-end Tue-start] 1fr [Tue-end Wed-start] 1fr [Wed-end Thu-start] 1fr [Thu-end Fri-start] 1fr [Fri-end Sat-start] 1fr [Sat-end];
            }
        }



        @media  (max-width: 600px) {
            .schedule {
                grid-template-rows:
                    [tracks] auto [time-0800] 1fr [time-0815] 1fr [time-0830] 1fr [time-0845] 1fr [time-0900] 1fr [time-0915] 1fr [time-0930] 1fr [time-0945] 1fr [time-1000] 1fr [time-1015] 1fr [time-1030] 1fr [time-1045] 1fr [time-1100] 1fr [time-1115] 1fr [time-1130] 1fr [time-1145] 1fr [time-1200] 1fr [time-1215] 1fr [time-1230] 1fr [time-1245] 1fr [time-1300] 1fr [time-1315] 1fr [time-1330] 1fr [time-1345] 1fr [time-1400] 1fr [time-1415] 1fr [time-1430] 1fr [time-1445] 1fr [time-1500] 1fr [time-1515] 1fr [time-1530] 1fr [time-1545] 1fr [time-1600] 1fr [time-1615] 1fr [time-1630] 1fr [time-1645] 1fr [time-1700] 1fr [time-1715] 1fr [time-1730] 1fr [time-1745] 1fr [time-1800] 1fr;
              

                grid-template-columns:
                    [times] 2rem [Mon-start] 1fr [Mon-end Tue-start] 1fr [Tue-end Wed-start] 1fr [Wed-end Thu-start] 1fr [Thu-end Fri-start] 1fr [Fri-end Sat-start] 1fr [Sat-end];
            }

            .schedule-wrapper {
                padding: 10px !important;

                width: 100% !important;
            }

           
        }




        .time-slot {
            grid-column: times;
        }

        .track-slot {
            display: none;
           
        }



        @supports(display:grid) {
            @media screen and (min-width:1px) {
                .track-slot {
                    display: block;
                    padding: 10px 5px 5px;

                    top: 0;

                }
            }
        }

        /* Small-screen & fallback styles */
        .session {
            margin-bottom: 1em;
        }

        @supports(display:grid) {
            @media screen and (min-width: 1px) {
                .session {
                    margin: 0;
                }


            }
        }



        /*************************
    * VISUAL STYLES
    * Design-y stuff ot particularly important to the demo
    *************************/
        .schedule-wrapper {
            padding: 20px;
            width: 90%;
            margin: 0 auto;
            /* line-height: 1.5; */
        }

        .session {
            padding: .5em;
            border-radius: 5px;
            font-size: 0.7rem;

        }

        .session-title,
        .session-time,
        .session-group,
        .session-teacher,
        .session-room {
            display: block;
        }


        .session-title,
        .time-slot {
            margin: 0;
            font-size: 0.8rem;
        }

        .session-title a {
            color: #fff;
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
            text-align: center;
            /* days and time */
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

        .week-change {
            color: var(--black);
            font-size: 0.8rem;


        }

        .week-wrapper {
            width: 100%;
            text-align: center;
            margin: auto;
        }
    </style>
</head>

<body>

    <main>


        <?php


        include('nav.php');

 
      

        $sessionGroup = $_SESSION['groupe_user'];




        $currentWeek = isset($_SESSION['currentWeek']) ? $_SESSION['currentWeek'] : date('W') - 1;

        if (isset($_GET['direction']) && $_GET['direction'] === 'next') {
            $currentWeek += 1;
        }

        if (isset($_GET['direction']) && $_GET['direction'] === 'previous') {
            $currentWeek -= 1;
        }

        if (isset($_GET['direction']) && $_GET['direction'] === 'today') {
            $currentWeek = date('W') - 1;
        }
        $currentWeek = max(0, $currentWeek);
        $_SESSION['currentWeek'] = $currentWeek;

        // echo "Current Week: $currentWeek<br>";
        function getStartAndEndDate($week, $year)
        {
            $dto = new DateTime();
            $dto->setISODate($year, $week);
            $start_date = $dto->format('d-m-Y');
            $dto->modify('+6 days');
            $end_date = $dto->format('d-m-Y');
            return [$start_date, $end_date];
        }

        // Get the start and end date for the current week
        [$startOfWeek, $endOfWeek] = getStartAndEndDate($currentWeek + 1, date('Y'));



        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');


        ?>


        <div class="week-wrapper">
            <a class="week-change" href="?direction=previous"><--  </a>
                    <a class="week-change" href="?direction=today">Cette Semaine</a>
                    <a class="week-change" href="?direction=next">  --></a>
        </div>



        <div class="schedule-wrapper">
            <div class="schedule" aria-labelledby="schedule-heading">

                <span class="track-slot" aria-hidden="true" style="grid-column: Mon; grid-row: tracks;"><?= strftime('%A <br>%d-%m-%Y', strtotime($startOfWeek)) ?></span>
                <span class="track-slot" aria-hidden="true" style="grid-column: Tue; grid-row: tracks;"><?= strftime('%A <br>%d-%m-%Y', strtotime($startOfWeek . ' +1 day')) ?></span>
                <span class="track-slot" aria-hidden="true" style="grid-column: Wed; grid-row: tracks;"><?= strftime('%A <br>%d-%m-%Y', strtotime($startOfWeek . ' +2 days')) ?></span>
                <span class="track-slot" aria-hidden="true" style="grid-column: Thu; grid-row: tracks;"><?= strftime('%A <br>%d-%m-%Y', strtotime($startOfWeek . ' +3 days')) ?></span>
                <span class="track-slot" aria-hidden="true" style="grid-column: Fri; grid-row: tracks;"><?= strftime('%A <br>%d-%m-%Y', strtotime($startOfWeek . ' +4 days')) ?></span>
                <span class="track-slot" aria-hidden="true" style="grid-column: Sat; grid-row: tracks;"><?= strftime('%A <br>%d-%m-%Y', strtotime($startOfWeek . ' +5 days')) ?></span>

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





                $requete = "
    SELECT cours_temps_debut, cours_temps_fin, cours_salle, ext_matiere, groupe, programme, couleur, id_matiere, nom_matiere, ext_prof, user_nom, user_prenom, exam
    FROM cours
    LEFT JOIN matiere ON cours.ext_matiere = matiere.id_matiere
    LEFT JOIN user ON matiere.ext_prof = user.id_user
    WHERE programme = :prog AND WEEK(cours_temps_debut) = :currentWeek";

                if ($sessionGroup === 'c') {
                    $requete .= " AND cours.groupe IN ('C', 'CD', 'M')";
                } elseif ($sessionGroup === 'a') {
                    $requete .= " AND cours.groupe IN ('A', 'AB', 'M')";
                } elseif ($sessionGroup === 'b') {
                    $requete .= " AND cours.groupe IN ('B', 'AB', 'M')";
                } elseif ($sessionGroup === 'd') {
                    $requete .= " AND cours.groupe IN ('D', 'CD', 'M')";
                }

                $stmt = $db->prepare($requete);
                $stmt->bindValue(':prog', $_SESSION['programme_user'], PDO::PARAM_STR);
                $stmt->bindValue(':currentWeek', $currentWeek, PDO::PARAM_INT);
                $stmt->execute();
                $allcourses = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // echo $currentWeek;
                foreach ($allcourses as $cours) {

                    $dateTimeStart = new DateTime($cours['cours_temps_debut']);
                    $dateTimeFinish = new DateTime($cours['cours_temps_fin']);

                    $dayOfWeek = $dateTimeStart->format('D');
                    $timeStart = $dateTimeStart->format('Hi');
                    $timeFinish = $dateTimeFinish->format('Hi');

                    $timeStartVisual = $dateTimeStart->format('H:i');
                    $timeFinishVisual = $dateTimeFinish->format('H:i');

                ?>
                    <div class="session session-1" style="grid-column: <?= $dayOfWeek ?>
; grid-row: time-<?= $timeStart ?> / time-<?= $timeFinish ?>; background-color: <?= $cours['couleur'] ?>; color: white;">
                        <?php
                        if ($cours['exam'] !== null) {
                            echo "<h4 style='color: var(--red);' class='session-title'>Examen</h4>";
                        }
                        ?>
                        <h3 class="session-title"><a href="cours.php?id=<?= $cours['id_matiere'] ?>"><?= $cours['nom_matiere'] ?></a></h3>
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

    </main>


</body>

</html>