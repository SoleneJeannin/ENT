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
    <title>Projet</title>





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
                padding-left: 130px;
                padding-right: 100px;
                padding-block: 30px;
                border-radius: 10px;
                margin-block-end: 10px;
                
            }

            .wrapper-info {
                display: flex;
                justify-content: space-between;

            }

            @media (max-width: 910px) {
                .wrapper {
                    height: auto;
                }

                main {
                    background-color: transparent !important;
                }

                .block {
                    text-align: center;
padding: 50px;
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
                    width: 90% !important;
                    text-align: center;
                    margin: auto !important;
                }
            }

            .exam-top-wrapper {
                /* height: 50%; */
                position: relative;
                /* top: ; */
            }

            /* 
            .info {
                width: 45%;
                border-right:  black solid 1px;
            } */

            .info {
                width: 30%;
            }

            .deposer {
                width: 30%;
            }

            .description>p {
                height: 55%;
                padding: 0px 20px;
                font-size: 1rem;

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
                margin-bottom: 0;
            }

            .date>span {
                display: block;
                margin-top: 10px;
                font-size: 1.5rem;
                font-weight: 500;
            }

            .data {
                margin-top: 50px;
                padding-left: 50px;
                margin-bottom: 30px;

            }

            .time {
                margin-top: 8px;
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
                justify-content: start;
                margin-bottom: 32px;


            }

            .note {
                font-size: 2.3rem;
                padding-left: 50px;
                font-weight: 200;

            }

            .pdf-wrapper {
                display: flex;
                padding: 20px;
                padding-top: 30px;

            }

            .button {
                display: inline-block;
                padding: 10px 15px;
                cursor: pointer;
                background-color: var(--yellow4);
                color: white;
                border: none;
                border-radius: 5px;
                text-decoration: none;

            }

            .inputfile {
                width: 0.1px;
                height: 0.1px;
                opacity: 0;
                overflow: hidden;
                position: absolute;
                z-index: -1;
            }

            #upload {
                display: inline-block;
                padding: 10px 20px;
                cursor: pointer;
                background-color: var(--red);
                color: white;
                border: none;
                border-radius: 5px;
                text-decoration: none;

                font-size: 1rem;
            }

            .wrapper2and3 {
                display: flex;
                width: 70%;
            }


            .wrapper2and3 h4 {
                margin-top: 0;
                margin-left: 20px;
            }

            .description {
                width: 70%;
            }

            form {
                display: flex;
                justify-content: space-between;
            }

            .consigne {
                margin-left: 50px;
            }

            .comment {
                width: 50%;
            }

            #fileNameDisplay {
                font-size: 0.9rem;
                padding-left: 20px;
            }

            .moyen {
                text-align: center;
                font-size: 1.3rem;
            }

            a {
                color: black;
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
                $idProjet = $_GET['id'];
            

                $requete = "SELECT


                    title_projet,
                    id_eval_projet,
                            eval_date_fin,
                            eval_date_debut,
                            nom_matiere,
                            id_matiere,
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
                        <h2> <a href="cours.php?id=<?= $projet['id_matiere'] ?? '' ?>"><?= $projet['nom_matiere'] ?? '' ?></a></h2>
                        <h2> <a href="mailto:<?= $projet['prof_prenom'] . '.' . $projet['prof_nom'] . '@univ-eiffel.fr' ?? '' ?>"><?= $projet['prof_prenom'] . ' ' . $projet['prof_nom'] ?? '' ?></a></h2>
                        <div class="data">
                            <p class="date"> Date de rendue: <br> <span class="date-span"><?= $projetStartDate ?? '' ?></span></p>
                            <p class="time"> jusqu'à <?= $projetEndTime ?? '' ?></p>
                        </div>
                    </div>



                    <div class="wrapper2and3">
                        <div class="description">
                            <h4>Description:</h4>
                            <p><?= $projet['description_projet'] ?? 'Pas de description ajoutée' ?></p>
                            <?php
                            if ($projet['consignes_projet'] !== null) {
                                echo "<a class='consigne button' href='./projet/{$projet['id_eval_projet']}/consignes/{$projet['consignes_projet']}'>Consignes</a>";
                            }
                            ?>


                        </div>


                        <div class="deposer">
                            <h4>Deposer le projet:</h4>
                            <form action="upload_projet.php" method="post" enctype="multipart/form-data">
                                <label for="file" class="custom-file-upload button">
                                    Choisir un Fichier
                                </label>
                                <input type="file" name="file" id="file" class="inputfile" onchange="displayFileName()" />

                                <input type="hidden" name="title_projet" value="<?= $projet['title_projet'] ?>">
                                <input type="hidden" name="id_projet" value="<?= $projet['id_eval_projet'] ?>">
                                <input type="hidden" name="student_name" value="<?= $_SESSION['user_prenom'] . "_" .  $_SESSION['user_nom'] ?>">
                                <button type="submit" id="upload" class="button">Envoyer</button>
                            </form>
                            <p style="font-size: 0.8rem;">Les formats: pdf, jpeg, zip</p>
                            <p id="fileNameDisplay"></p>
                        </div>
                    </div>
                </div>
            </div>




            <div class="exam-noted block">

                <div class="wrapper-botom">
                    <div class="info">
                        <h3>Note</h3>



                        <?php

                        $requete2 = " SELECT * FROM `note_projet` WHERE ext_projet = :id AND ext_etudiant = :id_user";
                        $stmt2 = $db->prepare($requete2);
                        $stmt2->bindValue(':id', $idProjet, PDO::PARAM_INT);
                        $stmt2->bindValue(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
                        $stmt2->execute();
                        $projet2 = $stmt2->fetch(PDO::FETCH_ASSOC);



                        ?>



                        <p class="note"> <?= $projet2['note_projet'] ?? 'Pas evalué' ?> / 20</p>
                    </div>
                    <div class="comment">
                        <h4>Commentaire de l'enseignant.e:</h4>
                        <p><?= $projet2['commentaire_projet'] ?? 'Pas de commentaire' ?> </p>
                    </div>

                    <div>
                        <h4>Moyen de promo:</h4>
                        <p class="moyen">


                            <?php
                            $requete = "SELECT AVG(note_projet) 
                        AS average_note 
                        FROM note_projet 
                        WHERE ext_projet = :id";


                            $stmt = $db->prepare($requete);
                            $stmt->bindValue(':id',   $idProjet, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                            echo $result['average_note'];


                            ?>


                        </p>
                    </div>
                </div>
            </div>
        </div>







    </main>
</body>
<script>
    function displayFileName() {
        const fileInput = document.getElementById('file');
        const fileNameDisplay = document.getElementById('fileNameDisplay');

        if (fileInput) {
            if (fileInput.files.length > 0) {
                const fileName = fileInput.files[0].name;
                fileNameDisplay.innerHTML = '<b> Le fichier sélectionné:</b><br>' + fileName;
            } else {
                fileNameDisplay.innerHTML = ''; // Clear the display if no file is selected
            }
        } else {
            console.error("Le fichier n'est pas trouvé pas");
        }
    }
</script>

</html>