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

        include('nav.php');

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

            .exam-top-wrapper {
                height: 50%;
            }

            /* 
            .info {
                width: 45%;
                border-right:  black solid 1px;
            } */

            .info
            {
                width: 30%;
            }

            .deposer {
                width: 30%;
            }

            .description > p {
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
            .date > span {
                display: block;
                margin-top: 10px;
                font-size: 1.5rem;
                font-weight: 500;
            }

            .data {
                margin-top: 50px;
                padding-left: 50px;

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

form {display: flex;
justify-content: space-between;}

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
            
        </style>




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
                            coefficient,
                            note,
                            description_projet,
                            commentaire_prof,
                            eval_projet.ext_etudiant AS etudiant_id,
                            matiere.ext_prof AS prof_id,
                            user_etudiant.user_nom AS etudiant_nom,
                            user_etudiant.user_prenom AS etudiant_prenom,
                            user_prof.user_nom AS prof_nom,
                            user_prof.user_prenom AS prof_prenom,
                            type,
                            id_eval_projet AS id_eval,
                            note_projet.note_projet,
                            note_projet.commentaire_projet
                        FROM
                            eval_projet
                        JOIN matiere ON matiere.id_matiere = eval_projet.ext_matiere
                        JOIN user AS user_etudiant ON eval_projet.ext_etudiant = user_etudiant.id_user
                        JOIN user AS user_prof ON matiere.ext_prof = user_prof.id_user
                        JOIN note_projet ON note_projet.ext_projet = eval_projet.id_eval_projet
                        WHERE
                            note_projet.ext_etudiant = user_etudiant.id_user
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



                    <div class="wrapper2and3">
                        <div class="description">
                            <h4>Description:</h4>
                            <p><?= $projet['description_projet'] ?? 'Pas de description ajoutée' ?></p>
                            <a class="consigne button" href="./projet/<?= $projet['id_eval_projet'] ?>/consignes_projet<?= $projet['id_eval_projet'] ?>.pdf">Consignes</a>
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
                                <input type="hidden" name="student_name" value="<?= $projet['etudiant_prenom'] . "_" . $projet['etudiant_nom'] ?>">
                                <button type="submit" id="upload" class="button">Envoyer</button>
                            </form>
                            <p id="fileNameDisplay"></p>
                        </div>
                    </div>
                </div>
            </div>




            <div class="exam-noted block">

                <div class="wrapper-botom">
                    <div class="info">
                        <h3>Note</h3>
                        <p class="note"> <?= $projet['note_projet'] ?? 'Pas evalué' ?> / 20</p>
                    </div>
                    <div class="comment">
                        <h4>Commentaire de l'enseignant.e:</h4>
                        <p><?= $projet['commentaire_projet'] ?? 'Pas de commentaire' ?> </p>
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
        console.error("File input element not found.");
    }
}

</script>

</html>