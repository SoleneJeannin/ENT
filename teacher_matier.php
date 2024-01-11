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
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&family=Lusitana:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style_de_base.css">
    <title>ENT Enseignant - Université Gustave Eiffel</title>

    <style>
        .accordion {
            background-color: var(--grey);
            color: black;
            border-radius: 10px;
            margin: 3px auto;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
            transition: 1s ease all;
        }

        .active,
        .accordion:hover {
            background-color: #ccc;
        }

        .panel {
            padding: 0 18px;
            display: none;
            background-color: white;
            overflow: hidden;
        }


        .wrapper {
            display: flex;
            flex-direction: row-reverse;
        }

        .right-block {
            width: 60%;
        }

        .left-block {
            width: 40%;
        }

        .exams {
            background-color: var(--grey);
        }

        .one-exam {
            width: 95%;
            background-color: white;
            margin: auto;
        }


        @media (max-width: 1250px) {
            .wrapper {
                flex-direction: column-reverse;
            }

            .right-block {
                width: 95%;
            }

            .left-block {
                width: 95%;
            }





        }

        @media (max-width: 900px) {

            .one-exam {
                width: 95% !important;
                margin-block: 0px !important;
            }

            main {
                background-color: white !important;
                padding-top: 20px;
                padding-inline: 8px;
            }
        }





        .exams {
            padding-block: 20px;
            display: flex;
            flex-wrap: wrap;
            width: 85%;
            margin: auto;
            border-radius: 25px;
            min-height: 30vh;
        }

        .one-exam p,
        .one-exam h4 {
            margin: 0;
        }

        .right-block,
        .left-block {
            padding: 50px;
        }

        .one-exam {
            height: min-content;
            width: 40%;
            margin: 10px 20px;
            border-radius: 15px;
            color: black;
            padding: 10px 30px;
        }

        .one-exam a {

            color: black;
        }

        .wrapper-info-exam {
            display: flex;
            justify-content: space-between;
        }


        .button-add {
            background-color: var(--red);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            margin: 0 auto 10px 50px;
            cursor: pointer;
        }

        .add-info-form input:not([type='submit']) {
            width: 65%;
        }

        textarea {
            width: 70%;
            height: 100px;
        }

        .supp-examens {
            text-align: right;

        }

        .button-submitSupp {
            position: absolute;
            cursor: pointer;
            background-color: var(--red);
            border-radius: 26px;
            border: none;
            padding: 5px 8px;
        }

        .suppOk {
            color: green;
        }

        .suppNon {
            color: red;
        }
        .none-exam{
            font-size: 1.3rem;
            padding: 15px;
        }
        .link-ajout{
            color: black;
        }
    </style>
</head>

<body>

    <main>


        <?php


        include('nav-teacher.php');




        ?>









        <div class="wrapper">
            <div class="right-block ">
                <h3>Examens</h3>
                <?php if (isset($_GET["confirmation"]) && $_GET["confirmation"] === "ok") {
                    ?>
                    <p class="suppOk">Vous avez bien supprimé l'examen.</p>
                    <?php
                }
                if (isset($_GET["confirmation"]) && $_GET["confirmation"] === "non") {
                    ?>
                    <p class="suppNon">Un problème est survenu lors de votre suppression</p>
                    <?php
                } ?>
                <div class="exams">
                    <?php


                    $matiereId = $_GET['id_matiere'];

                    $requete3 = "SELECT * FROM eval_exam LEFT JOIN cours ON eval_exam.ext_cours = cours.id_cours WHERE cours.ext_matiere = :id_m;
                                ";



                    $stmt3 = $db->prepare($requete3);
                    $stmt3->bindValue(':id_m', $matiereId, PDO::PARAM_STR);
                    $stmt3->execute();


                    $exams = $stmt3->fetchAll(PDO::FETCH_ASSOC);


                    if (empty($exams)) {
                        ?><p class="none-exam"> Pas d'examen : <a class="link-ajout" href="teacher_new_exam.php">Ajoutez un examen</a></p>
                        <?php
                    }else{

                    foreach ($exams as $exam) {

                        $start = new DateTime($exam['cours_temps_debut']);
                        $end = new DateTime($exam['cours_temps_fin']);

                        $dateStart = $start->format('n/j/Y');

                        $TimeStart = $start->format('H:i');
                        $TimeEnd = $end->format('H:i');

                        ?>



                        <div class="one-exam">
                            <form class="supp-examens" action="teacher_matiere_supp_exam.php" method="POST">
                                <input type="hidden" name="idMatiere" value="<?= $_GET["id_matiere"] ?>">
                                <input type="hidden" name="idExam" value="<?= $exam["id_eval_exam"] ?>">
                                <input class="button-submitSupp" type="submit" value="X">
                            </form>
                            <a href="teacher_exam.php?id_exam=<?= $exam['id_eval_exam'] ?>">
                                <h4>
                                    <?= $exam['title_exam'] ?>
                                </h4>
                                <div class="wrapper-info-exam">
                                    <div>
                                        <p class="date-exam">
                                            <?= $dateStart ?>
                                        </p>
                                        <p class="time-exam">
                                            <?= $TimeStart . ' - ' . $TimeEnd ?>
                                        </p>
                                    </div>
                                    <div style="text-align: right;">
                                        <p class="salle_exam"> Salle:
                                            <?= $exam['cours_salle'] ?>
                                        </p>
                                        <p class="group_exam">



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
                                        </p>
                                    </div>
                                </div>

                            </a>
                        </div>
                    <?php }}
                    ; ?>




                </div>
                <h3>Projets</h3>
                <?php if (isset($_GET["confirmationProj"]) && $_GET["confirmationProj"] === "ok") {
                    ?>
                    <p class="suppOk">Vous avez bien supprimé l'examen.</p>
                    <?php
                } else
                    echo "";
                if (isset($_GET["confirmationProj"]) && $_GET["confirmationProj"] === "non") {
                    ?>
                    <p class="suppNon">Un problème est survenu lors de votre suppression</p>
                    <?php
                } else
                    echo ""; ?>
                <div class="exams">

                    <?php


                    $matiereId = $_GET['id_matiere'];

                    $requete4 = "SELECT * FROM eval_projet WHERE eval_projet.ext_matiere = :id_m;
            ";



                    $stmt4 = $db->prepare($requete4);
                    $stmt4->bindValue(':id_m', $matiereId, PDO::PARAM_STR);
                    $stmt4->execute();


                    $projets = $stmt4->fetchAll(PDO::FETCH_ASSOC);

                    if (empty($projets)) {
                        ?><p class="none-exam"> Pas de projet : <a class="link-ajout" href="teacher_new_projet.php">Ajoutez un projet</a></p><?php
                    }else{

                    foreach ($projets as $projet) {

                        $start = new DateTime($projet['eval_date_debut']);
                        $end = new DateTime($projet['eval_date_fin']);

                        $dateEndProjet = $end->format('n/j/Y');
                        $TimeEndProjet = $end->format('H:i');

                        ?>


                        <div class="one-exam">
                            <form class="supp-examens" action="teacher_matiere_supp_projets.php" method="POST">
                                <input type="hidden" name="idMatiere" value="<?= $_GET["id_matiere"] ?>">
                                <input type="hidden" name="idProjet" value="<?= $projet["id_eval_projet"] ?>">
                                <input class="button-submitSupp" type="submit" value="X">
                            </form>
                            <a href="teacher_projet.php?id_projet=<?= $projet['id_eval_projet'] ?>">
                                <h4>
                                    <?= $projet['title_projet'] ?>
                                </h4>
                                <div class="wrapper-info-exam">
                                    <div>
                                        <p class="date-exam">
                                            <?= $dateEndProjet ?>
                                        </p>
                                        <p class="time-exam">
                                            <?= "jusqu'à " . $TimeEndProjet ?>
                                        </p>
                                    </div>
                                    <div style="text-align: right;">



                                    </div>
                                </div>

                            </a>
                        </div>
                    <?php }}
                    ; ?>





                </div>



            </div>





            <div class="left-block">

                <?php
                $matiereId = $_GET['id_matiere'];

                $requete = "SELECT * FROM matiere
                    WHERE id_matiere = :id_m;
                    ";



                $stmt = $db->prepare($requete);
                $stmt->bindValue(':id_m', $matiereId, PDO::PARAM_STR);
                $stmt->execute();
                $one = $stmt->fetch(PDO::FETCH_ASSOC);


                ?>



                <h1>
                    <?= $one['nom_matiere'] ?>
                </h1>


                <h4>Description:</h4>
                <p>
                    <?= $one['description'] ?>
                </p>





                <h2>Information</h2>


                <button class="button-add" onclick="toggleAddingInfo()">Ajouter Information</button>

                <div class="adding-info" id="addingInfoDiv" style="display: none;">
                    <form class="add-info-form" action="add_info.php" method="POST">
                        <label for="title">Titre: <input type="text" name="title" id="title"></label><br>
                        <label for="text">Information: <br><textarea name="text" id="text"></textarea></label>

                        <input type="hidden" name="matiere" value="<?= $one['id_matiere'] ?>">
                        <br>
                        <input class="submit-b" type="submit" value="Envoyer">
                    </form>
                </div>

                <script>
                    function toggleAddingInfo() {
                        var addingInfoDiv = document.getElementById('addingInfoDiv');
                        addingInfoDiv.style.display = (addingInfoDiv.style.display === 'none' || addingInfoDiv.style.display === '') ? 'block' : 'none';
                    }
                </script>







                <?php


                $matiereId = $_GET['id_matiere'];

                $requete2 = "SELECT * FROM matiere
                LEFT JOIN info_matiere ON id_matiere = ext_matiere
                WHERE id_matiere = :id_m;
                ";



                $stmt2 = $db->prepare($requete2);
                $stmt2->bindValue(':id_m', $matiereId, PDO::PARAM_STR);
                $stmt2->execute();


                $allinfo = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                foreach ($allinfo as $info) {

                    $date = new DateTime($info['info_date']);
                    $dateFormated = $date->format('n/j/Y');

                    ?>

                    <style>
                        .delete-info {
                            color: var(--red);
                            font-weight: 900;
                            position: absolute;
                            right: 30px;
                        }

                        .accordion {
                            position: relative;
                        }
                    </style>




                    <button class="accordion">
                        <?= $dateFormated . '  ' . $info['info_titre'] ?> <a
                            href="./delete_info.php?id_info=<?= $info['id_info'] ?>"><span class="delete-info">X</span></a>
                    </button>
                    <div class="panel">

                        <p>
                            <?= $info['information'] ?>
                        </p>
                    </div>

                    <?php


                }
                ;

                ?>
            </div>
        </div>


    </main>



</body>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>

</html>