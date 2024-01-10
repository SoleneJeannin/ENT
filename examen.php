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
    <title>Examen</title>

    <style>
        main {
            background-color: var(--grey);
            position: relative;
        }

        .wrapper {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: max-content;

            height: 90%;
        }

        .block {
            background-color: white;
            width: 90%;
            padding-inline: 130px;
            padding-block: 30px;
            border-radius: 10px;
            margin-block-end: 10px;
        }

        .wrapper-info {
            display: flex;
            justify-content: start;

        }

        .exam-top-wrapper {
            height: 50%;
        }

        .description {
            width: 60%;
            margin-left: 100px;
        }

        .comment {
            width: 40%;
        }

        h1 {
            margin-bottom: 20px;
            font-weight: 800;
        }

        h2 {
            padding-left: 50px;
            font-weight: 400;
            margin: 0;
            font-size: 1.3rem;
            text-decoration: underline;
            text-decoration-thickness: 1px;
            text-underline-offset: 4px;
        }

        h4 {
            font-size: 1.3rem;
        }

        p {
            font-size: 1.12rem;
            margin: 10px;
        }

        .date {
            font-size: 1.5rem;
            font-weight: 500;
        }

        .data {
            margin-top: 50px;
            padding-left: 50px;

        }

        .exam-noted {
            padding-left: 150px;
        }

        .exam-noted h3 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0;
        }

        .wrapper-botom {
            display: flex;
            justify-content: space-between;
            margin-bottom: 32px;


        }

        .note {
            font-size: 2.3rem;
            padding-left: 50px;
            font-weight: 200;

        }

        .moyen {
            margin-inline: 100px;
        }

        .moyen>p {
            text-align: center;

        }

        @media (max-width: 910px) {
            .wrapper {
                height: auto;
            }

            .description {
                margin-left: 0;
                margin: auto;
            }

            main {
                background-color: transparent !important;
            }

            .block {
                text-align: center;
                padding: 50px;
            }

            .data,
            .info>h2 {
                padding-left: 0;
                text-align: center;
            }

            .comment,
            .moyen {
                width: 90%;
            }

            .wrapper-info {
                flex-direction: column;
                justify-content: center;
            }

            .info {
                width: 95% !important;
            }

            .wrapper2and3 {
                display: flex;
                width: 95% !important;
                flex-direction: column;
                align-items: center;
            }

            .deposer {
                width: 90% !important;
            }

            .exam-noted {
                padding-inline: 20px !important;
            }

            .wrapper-botom {
                flex-direction: column;
                align-items: center;
                width: 100% !important;
                text-align: center;
                margin: auto !important;
            }
        }
    </style>
</head>


<body>

    <main>


        <?php

        include('nav.php');

        ?>






        <div class="wrapper">

            <div class="exam-top-wrapper block">

                <?php
                $idExam = $_GET['id'];



                $requete = "SELECT
        title_exam,
        cours_temps_fin,
        cours_temps_debut,
        nom_matiere,
        coefficient,
        description_exam,
        matiere.ext_prof AS prof_id,
        user_prof.user_nom AS prof_nom,
        user_prof.user_prenom AS prof_prenom,
        type,
        id_eval_exam,
        cours_salle
    FROM
        eval_exam
    JOIN cours ON cours.id_cours = eval_exam.ext_cours
    JOIN matiere ON matiere.id_matiere = cours.ext_matiere
    JOIN user AS user_prof ON matiere.ext_prof = user_prof.id_user
WHERE
    id_eval_exam = :id";

                $stmt = $db->prepare($requete);
                $stmt->bindValue(':id', $idExam, PDO::PARAM_INT);
                $stmt->execute();
                $exam = $stmt->fetch(PDO::FETCH_ASSOC);



                $dateStart = new DateTime($exam['cours_temps_debut']);
                $dateEnd = new DateTime($exam['cours_temps_fin']);

                $examStartDate =    $dateStart->format('j F Y');
                $examStartTime =  $dateStart->format('H:i');

                $examEndDate =    $dateEnd->format('j F Y');
                $examEndTime =  $dateEnd->format('H:i');
                ?>



                <h1>Examen: <?= $exam['title_exam'] ?? '' ?> </h1>

                <div class="wrapper-info">
                    <div class="info">
                        <h2> <a href="cours.php?id=<?= $exam['id_matiere'] ?? '' ?>"><?= $exam['nom_matiere'] ?? '' ?></a></h2>
                        <h2> <a href="mailto:<?= $exam['prof_prenom'] . '.' . $exam['prof_nom'] . '@univ-eiffel.fr' ?? '' ?>"><?= $exam['prof_prenom'] . ' ' . $exam['prof_nom'] ?? '' ?></a></h2>
                        <div class="data">
                            <p class="date"> <?= $examStartDate ?? '' ?></p>
                            <p class="time"><?= $examStartTime . ' - ' . $examEndTime ?? '' ?></p>
                            <p>Salle <?= $exam['cours_salle'] ?? '' ?></p>
                        </div>
                    </div>
                    <div class="description">
                        <h4>Description:</h4>
                        <p><?= $exam['description_exam'] ?? 'Pas de description ajoutée' ?></p>
                    </div>
                </div>
            </div>

            <?php

            $requete = " SELECT * FROM `note_exam` WHERE ext_eval_exam = :id AND ext_etudiant = :id_user";
            $stmt = $db->prepare($requete);
            $stmt->bindValue(':id', $idExam, PDO::PARAM_INT);
            $stmt->bindValue(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
            $stmt->execute();
            $exam2 = $stmt->fetch(PDO::FETCH_ASSOC);



            ?>

            <div class="exam-noted block">

                <div class="wrapper-botom">
                    <div class="info">
                        <h3>Note</h3>
                        <p class="note"> <?= $exam2['note_exam'] ?? '-' ?> / 20</p>
                    </div>
                    <div class="comment">
                        <h4>Commentaire de l'enseignant.e:</h4>
                        <p><?= $exam2[' commentaire_exam'] ?? 'Pas de commentaire' ?> </p>
                    </div>



                    <div class="moyen">
                        <h4>Moyen de promo:</h4>
                        <p>


                            <?php
                            $requete = "SELECT AVG(note_exam) 
                        AS average_note 
                        FROM note_exam 
                        WHERE ext_eval_exam = :id";


                            $stmt = $db->prepare($requete);
                            $stmt->bindValue(':id',   $idExam, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                            echo $result['average_note'] ?? '-';


                            ?>


                        </p>
                    </div>
                </div>
            </div>
        </div>







    </main>
</body>

</html>