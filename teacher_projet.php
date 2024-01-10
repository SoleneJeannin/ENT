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
    <title>Projet</title>


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
                $idProjet = $_GET['id_projet'];

                $_SESSION['id_user'] = 3;


                $requete = "SELECT


                title_projet,
                id_eval_projet,
                        eval_date_fin,
                        eval_date_debut,
                        nom_matiere,
                        coefficient,
                        description_projet,
                     
                       
                        matiere.ext_prof AS prof_id,
                     
                        user_prof.user_nom AS prof_nom,
                        user_prof.user_prenom AS prof_prenom,
                        consignes_projet,
                        type,
                        id_eval_projet AS id_eval
                    FROM
                        eval_projet
                    JOIN matiere ON matiere.id_matiere = eval_projet.ext_matiere
                   
                    JOIN user AS user_prof ON matiere.ext_prof = user_prof.id_user
                  
                        AND id_eval_projet = :id";






                $stmt = $db->prepare($requete);
                $stmt->bindValue(':id', $idProjet, PDO::PARAM_INT);
                $stmt->execute();
                $projet = $stmt->fetch(PDO::FETCH_ASSOC);

                $dateStart = new DateTime($projet['eval_date_debut']);
                $dateEnd = new DateTime($projet['eval_date_fin']);

                $projetStartDate =    $dateStart->format('j F Y');
                $projetStartTime =  $dateStart->format('H:i');

                $projetEndDate =    $dateEnd->format('j F Y');
                $projetEndTime =  $dateEnd->format('H:i');



                ?>




                <h1>Projet: <?= $projet['title_projet'] ?? '' ?> </h1>

                <div class="wrapper-info">
                    <div class="info">
                        <h2> <?= $projet['nom_matiere'] ?? '' ?></h2>
                        <h2> <?= $projet['prof_prenom'] . ' ' . $projet['prof_nom'] ?? '' ?></h2>
                        <div class="data">
                            <p class="date"> Date de rendue: <br> <span class="date-span"><?= $projetStartDate ?? '' ?></span></p>
                            <p class="time"> jusqu'à <?= $projetEndTime ?? '' ?></p>


                        </div>
                    </div>
                    <div class="description">
                        <h4>Description:</h4>
                        <p><?= $projet['description_projet'] ?? 'Pas de description ajoutée' ?></p>
                        <?php
                        if ($projet['consignes_projet'] !== null) {
                            echo "<a class='consigne button' href='./projet/{$projet['id_eval_projet']}/consignes/{$projet['consignes_projet']}.pdf'>Consignes</a>";
                        }
                        ?>
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

                        .ajouter-notes {
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
                                <th>Commentaire</th>
                                <th>Note</th>
                            </tr>

                            <?php

                            $_SESSION['user_programme'] = 'MMI1';

                            $requete = "SELECT *
                            FROM user
                            JOIN matiere ON user.user_programme = matiere.programme
                            JOIN eval_projet ON matiere.id_matiere = eval_projet.ext_matiere
                           
                            LEFT JOIN note_projet ON ext_projet = id_eval_projet AND ext_etudiant = user.id_user
                            WHERE id_eval_projet = :id ";
                            $stmt = $db->prepare($requete);
                            $stmt->bindValue(':id', $idProjet, PDO::PARAM_INT);
                            $stmt->execute();
                            $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if (!empty($notes)) {
                                foreach ($notes as $note) {
                            ?>

                                    <tr>
                                        <td><?= $note['id_user'] ?></td>
                                        <td><?= $note['user_prenom'] . " " . $note['user_nom'] ?></td>
                                        <td><?= $note['commentaire_projet'] ?></td>
                                        <td><?= $note['note_projet'] ?></td>

                                    </tr>

                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="3">Pas de notes</td></tr>';
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
                            JOIN matiere ON user.user_programme = matiere.programme
                            JOIN eval_projet ON matiere.id_matiere = eval_projet.ext_matiere
                           
                            LEFT JOIN note_projet ON ext_projet = id_eval_projet AND ext_etudiant = user.id_user
                            WHERE id_eval_projet = :id AND note_projet IS NULL";

                            $stmt2 = $db->prepare($requete2);
                            $stmt2->bindValue(':id', $idProjet, PDO::PARAM_INT);

                            $stmt2->execute();
                            $addnote = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                            $addone = $stmt2->fetch(PDO::FETCH_ASSOC);




                            ?>

                            <form class="form-add" action="add_new_note_projet.php" method="POST">

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

                                <input type="hidden" name="id_projet" value="<?= $_GET['id_projet'] ?>">

                                <label for="comment">Commentaire:</label>
                                <textarea name="comment" id="comment"></textarea>
                                <br>

                                <br>
                                <input id="aj" type="submit" value="Ajouter">

                            </form>

                            <?php
                            $allStudentsEvaluated = true;

                            foreach ($addnote as $student) {
                                if ($student['evaluated'] === 0) {
                                    $allStudentsEvaluated = false;
                                    break;
                                }
                            }

                            if ($allStudentsEvaluated) {
                                echo '<p>Tous.tes les étudiants.es sont évalué.e.s</p>';
                                echo '<script>document.getElementById("add-add").style.display = "none";</script>';
                            }
                            ?>
                            <div class="moyen">
                                <h4>Moyen:</h4>
                                <p>


                                    <?php
                                    $requete = "SELECT AVG(note_projet) 
                                    AS average_note 
                                    FROM note_projet 
                                    WHERE ext_projet = :id";


                                    $stmt = $db->prepare($requete);
                                    $stmt->bindValue(':id',   $idProjet, PDO::PARAM_INT);
                                    $stmt->execute();
                                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                    echo $result['average_note'] ?? '-';


                                    ?>


                                </p>
                            </div>
                        </div>



                        <div class="uploaded">
                            <h3>Les documents rendus</h3>



                            <ul>
                                <?php
                                $folder = "projet/" . $idProjet;

                                if (is_dir($folder) && ($files = scandir($folder)) !== false) {
                                    $allowedExtensions = ["pdf", "jpg", "jpeg", "zip"];

                                    foreach ($files as $file) {
                                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                        if (in_array($fileExtension, $allowedExtensions)) {
                                            echo "<li><a href='$folder/$file' target='_blank'>$file</a></li>";
                                        }
                                    }
                                } else {
                                    echo "<p>Pas de projets ajoutés pour l'instant</p>";
                                }
                                ?>

                            </ul>

                        </div>



                    </div>






            </div>
        </div>
        </div>







    </main>
</body>

</html>