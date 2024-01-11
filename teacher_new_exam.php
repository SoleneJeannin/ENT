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

    <style>
        .big-wrapper {
            display: flex;
        }

        .add-exam {
            width: 40%;
            padding: 50px 100px;
        }

        .one-matiere a {
            color: black;
            font-size: 1rem;

        }

        .one-matiere {
            background-color: var(--yellow1);
            border-radius: 15px;
            padding: 15px 15px;
            margin-block: 5px;
        }

        .one-matiere h2 {
            margin: 0;
            padding-left: 30px;

        }

        .choose-class {
            width: 60%;
            padding: 50px;
        }

        .choose-class input,
        textarea {
            width: 13vw;

        }

        #form-cours {
            margin-left: 50px;
        }

        .submit {
            background-color: var(--red);
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 1.1rem;
        }

        @media (max-width: 900px) {
            main {
                background-color: white;
                padding: 10px;
            }
        }

        @media (max-width: 1220px) {
            .big-wrapper {
                flex-direction: column;
                align-items: center;
            }

            .add-exam {
                width: 80%;
                padding-inline: 0;
            }

            .choose-class {
                width: 80%;
                margin: auto;
            }

            input,
            textarea {
                width: 300px !important;
            }

            form {
                display: block;
                margin: auto !important;
            }



        }
    </style>
</head>

<body>

    <main>


        <?php


        include('nav-teacher.php');
 
        $prof = $_SESSION['id_user'];

        $requete2 = "SELECT DISTINCT *
         FROM matiere 
WHERE   ext_prof = :prof ";


        $stmt2 = $db->prepare($requete2);
        $stmt2->bindValue(':prof', $prof, PDO::PARAM_INT);
        $stmt2->execute();
        $matiere = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        ?>




        <div class="big-wrapper">
            <div class="add-exam">
                <h1>Ajouter un exam</h1>
                <div class="matiers-all">
                    <?php foreach ($matiere as $onem) : ?>
                        <div class="one-matiere">
                            <a href="teacher_new_exam.php?matiere=<?= $onem['id_matiere'] ?>">
                                <h2> <?= $onem['nom_matiere']   ?></h2>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>




            <Div class="choose-class">
                <h1>Choisir le cours</h1>
                <?php
                if (isset($_GET['matiere'])) {
                    $matiere = $_GET['matiere'];
                    $requete = "SELECT *
                        FROM matiere, cours
            
                    WHERE id_matiere = ext_matiere AND ext_prof = :prof AND id_matiere = :matiere";
                    $stmt = $db->prepare($requete);
                    $stmt->bindValue(':prof', $prof, PDO::PARAM_INT);
                    $stmt->bindValue(':matiere', $matiere, PDO::PARAM_INT);
                    $stmt->execute();
                    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($courses == NULL) {
                        echo "Pas de cours pour lq matière choisie";
                    }
                }


                ?>
                <form id="form-cours" name="form-cours" action="add_exam.php" method="POST">
                    <select name="cours" id="cours">
                        <?php foreach ($courses as $cours) {
                            $dateStart = new DateTime($cours['cours_temps_debut']);
                            $dateEnd = new DateTime($cours['cours_temps_fin']);
                            $examStartDate =    $dateStart->format('j F Y');
                            $examStartTime =  $dateStart->format('H:i');
                            $examEndDate =    $dateEnd->format('j F Y');
                            $examEndTime =  $dateEnd->format('H:i');


                        ?>


                            <option value="<?= $cours['id_cours'] ?>">
                                <?= $examStartDate . '  ' . $examStartTime  . ' - ' . $examEndTime  ?> <span>
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
                            </option>
                        <?php }; ?>
                    </select>
                    <br><br>
                    <label for="coef">Coefficient: <br></label><input type="number" name="coef" id="coef">
                    <br><br>
                    <label for="title">Titre: <br> </label><input type="text" name="title" id="title">
                    <br><br>
                    <label for="desc">Description: <br></label><textarea name="desc" id="desc"></textarea>
                    <br><br>
                    <input class="submit" type="submit" value="Choisir cours">
                </form>
            </Div>
        </div>


    </main>


</body>

</html>