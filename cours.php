<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&family=Lusitana:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_de_base.css">
    <link rel="stylesheet" href="cours.css">
    <title>Cours - contenu</title>


</head>

<body>

    <main>
        <?php
        include('nav.php');
        include('connexion.php');
        ?>

        <?php

        $requeteContenu = "SELECT * FROM info_matiere WHERE ext_matiere=:id_matiere";
        $stmtContenu = $db->prepare($requeteContenu);
        $stmtContenu->bindParam(':id_matiere', $_GET["id"], PDO::PARAM_INT);
        $stmtContenu->execute();
        $resultsContenu = $stmtContenu->fetchall(PDO::FETCH_ASSOC);

        $requeteMatiere = "SELECT * FROM matiere WHERE id_matiere=:id_matiere";
        $stmtMatiere = $db->prepare($requeteMatiere);
        $stmtMatiere->bindParam(':id_matiere', $_GET["id"], PDO::PARAM_INT);
        $stmtMatiere->execute();
        $resultsMatiere = $stmtMatiere->fetch(PDO::FETCH_ASSOC);
        $ext_prof = $resultsMatiere["ext_prof"];

        $requeteProfesseur = "SELECT user_nom,user_prenom FROM user WHERE id_user=:ext_prof";
        $stmtProfesseur = $db->prepare($requeteProfesseur);
        $stmtProfesseur->bindParam(':ext_prof', $ext_prof, PDO::PARAM_INT);
        $stmtProfesseur->execute();
        $resultsProfesseur = $stmtProfesseur->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="cours">
            <div>
                <p class="nom_matiere">
                    <?= $resultsMatiere["nom_matiere"]; ?>
                </p>
                <p class="nom_prof">
                    <?= ucwords($resultsProfesseur["user_nom"]) . " " . ucwords($resultsProfesseur["user_prenom"]) ?>
                </p>
            </div>
            <?php
            if ($stmtContenu->rowCount() > 0) {

                foreach ($resultsContenu as $row) {

            ?>


                    <div>
                        <button class="visible cours-contenu" onclick="toggleAnswer('coursContenu<?= $row['id_info'] ?>')">

                            <img class="toggle-img" src="./img/cours/arrow-down-circle.svg" alt="">
                            <span class="cours-titre">

                                <?= $row["info_titre"] ?>
                            </span><br>
                        </button>
                        <div class="cours-contenu-information hidden" id="coursContenu<?= $row['id_info'] ?>">
                            <p>
                                <?= $row["information"] ?>
                            </p>
                        </div>
                    </div>


                <?php
                }
            } else {
                ?>
                <div>
                    <p>Le professeur n'a pas encore posté de contenu pour votre matière</p>
                </div>
            <?php
            } ?>
        </div>


<div>
    
    
            <?php
            $requetEvaluation = "SELECT * FROM eval_exam"
            ?>
            <div class="evaluation cours">
                <h2>Vos Évaluations</h2>
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

    </main>


</body>
<script>
    function toggleAnswer(coursId) {
        var coursContenu = document.getElementById(coursId);
        coursContenu.classList.toggle("hidden");
        coursContenu.classList.toggle("animSmooth");
    }
</script>

</html>