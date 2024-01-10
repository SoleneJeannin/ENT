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
    <title>Examen</title>


</head>


<body>

    <main>


        <?php

        include('nav-teacher.php');

        ?>



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
                justify-content: start;
                padding-block: 20px;
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
                flex-direction: column;
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
        </style>




        <div class="wrapper">

            <div class="exam-top-wrapper block">

                <?php
                $idExam = $_GET['id_exam'];

                $_SESSION['id_user'] = 3;


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
        cours_salle,
        groupe
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



                <h1>Examen: <?= $exam['title_exam'] ?? '' ?>  <span>
                                <?php
                                $group = $exam['groupe'];

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

                            </span></h1>

                <div class="wrapper-info">
                    <div class="info">
                        <h2> <?= $exam['nom_matiere'] ?? '' ?></h2>
                        <h2> <?= $exam['prof_prenom'] . ' ' . $exam['prof_nom'] ?? '' ?></h2>
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

            <div class="exam-noted block">

                <d iv class="wrapper-botom">

                    <h3>Notes</h3>
                    <br>

                    <style>
                        .table {
                            width: 90%;
                            margin: auto;

                        }

                        .table td {
                            padding: 5px;
                        }

                        tr:nth-child(even) {
    background-color: var(--yellow1);
}

.form-add {
    width: 60%;
    margin: auto;
}
.ajouter-notes  {
    display: flex;
    margin: auto;
}

#aj {
    background-color: var(--red);
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    font-size: 1.1rem;
}

                    </style>
                    <div class="all-notes">

                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Groupe</th>
                                <th>Commentaire</th>
                                <th>Note</th>
                            </tr>

                            <?php

                            $_SESSION['user_programme'] = 'MMI1';

                            $requete = "SELECT *
                            FROM user
                            JOIN cours ON (
        (cours.groupe = user.user_groupe) OR
        (cours.groupe = 'ab' AND user.user_groupe IN ('a', 'b')) OR
        (cours.groupe = 'cd' AND user.user_groupe IN ('c', 'd')) OR
        (cours.groupe = 'm' AND user.user_groupe IN ('a', 'b', 'c', 'd'))
    )
                            JOIN eval_exam ON cours.id_cours = eval_exam.ext_cours
                            JOIN matiere ON cours.ext_matiere = matiere.id_matiere
                            LEFT JOIN note_exam ON ext_eval_exam = id_eval_exam AND ext_etudiant = user.id_user
                            WHERE id_eval_exam = :id AND user_programme = :programme";
                            $stmt = $db->prepare($requete);
                            $stmt->bindValue(':id', $idExam, PDO::PARAM_INT);
                            $stmt->bindValue(':programme', $_SESSION['user_programme'], PDO::PARAM_INT);
                            $stmt->execute();
                            $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if (!empty($notes)) {
                                foreach ($notes as $note) {
                            ?>

                                    <tr>
                                        <td><?= $note['id_user'] ?></td>
                                        <td><?= $note['user_prenom'] . " " . $note['user_nom'] ?></td>
                                        <td><?= $note['user_groupe'] ?></td>
                                        <td><?= $note['commentaire_exam'] ?></td>
                                        <td><?= $note['note_exam'] ?></td>

                                    </tr>

                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="3">No notes found</td></tr>';
                            }
                            ?>
                        </table>
<br>

                        <h3>Ajouter des notes</h3>
<br><br>


                        <div class="ajouter-notes">
                            <?php
                            $requete2 = "SELECT *
                                                        FROM user
                                                        JOIN cours ON (
                                    (cours.groupe = user.user_groupe) OR
                                    (cours.groupe = 'ab' AND user.user_groupe IN ('a', 'b')) OR
                                    (cours.groupe = 'cd' AND user.user_groupe IN ('c', 'd')) OR
                                    (cours.groupe = 'm' AND user.user_groupe IN ('a', 'b', 'c', 'd'))
                                )
                            JOIN eval_exam ON cours.id_cours = eval_exam.ext_cours
                            JOIN matiere ON cours.ext_matiere = matiere.id_matiere
                            LEFT JOIN note_exam ON ext_eval_exam = id_eval_exam AND ext_etudiant = user.id_user
                            WHERE id_eval_exam = :id AND user_programme = :programme AND note_exam IS NULL";
                            $stmt2 = $db->prepare($requete2);
                            $stmt2->bindValue(':id', $idExam, PDO::PARAM_INT);
                            $stmt2->bindValue(':programme', $_SESSION['user_programme'], PDO::PARAM_INT);
                            $stmt2->execute();
                            $addnote = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                            




                            ?>

                            <form class="form-add" action="add_new_note_exam.php" method="POST">

                                <label for="selectedStudents">Select Students:</label>
                                <select name="selectedStudent" id="selectedStudent">

                                    <?php foreach ($addnote as $student) : ?>
                                        <option value="<?= $student['id_user'] ?>">

                                            <?= $student['user_prenom'] . ' ' . $student['user_nom'] ?>

                                        </option>
                                    <?php endforeach; ?>

                                </select>
                                <br><br>
                                <label for="note">Note:</label>
                                <input type="text" name="note" id="note">
                                <br><br>

                                <input type="hidden" name="id_exam" value="<?= $_GET['id_exam'] ?>">

                                <label for="comment">Commentaire:</label>
                                <textarea name="comment" id="comment"></textarea>
                                <br>

                                <br>
                                <input id="aj" type="submit" value="Ajouter">

                            </form>
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
        </div>
        </div>







    </main>
</body>

</html>