<?php session_start(); ?>
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
        <?php
        $requetEvaluation = "SELECT * FROM eval_exam"
            ?>
        <div class="evaluation cours">
            <h2>Vos Évaluations</h2>
            <?php 
            // Je souhaite obtenir les évaluations 
            
            ?>
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