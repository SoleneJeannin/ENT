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
    <link rel="stylesheet" href="matiere_ajout_admin.css">
    <title>Ajout matière</title>


</head>

<body>

    <main>


        <?php

        session_start();
        include('nav_admin.php');
        include('connexion.php');

        ?>

        <form action="matiere_traite_ajout_admin.php">
            <h1>Ajoutez des matières</h1>
            <p class="obli"> <span>*</span>Champs Obligatoire</p>
            <div class="centrer">
            <div class="bloc_form">
            <?php if(isset($_GET["ok"])){
                ?> 
                <p>Vous avez bien inséré une matière</p>
                <?php
            }?>

            <div>
            <label for="programme">
                Programme<span class="red">*</span> :
            </label><br>
            <select name="programme" id="programme" required>
                <option value="MMI1">MMI1</option>
                <option value="MMI2">MMI2</option>
                <option value="MMI3">MMI3</option>
            </select>
            </div>


            <div>
            <label for="matiere-titre">
                Le titre de la matière<span class="red">*</span> :
            </label><br>
            <input type="text" name="matiere-titre" id="matiere-titre" required>
            </div>


          

            <div>
            <label for="description">
                Description<span class="red">*</span> :
            </label><br>
            <input type="text" name="description" id="description" required>
            </div>


            

            <div>
            <label for="couleur">
                Couleur<span class="red">*</span> :
            </label>

            <select name="couleur" id="couleur" required>
                <option value="red">Rouge</option>
                <option value="blue">Bleu</option>
                <option value="green">Vert</option>
            </select>
            </div>


            
            <!-- Récupérer tous les identifiants des professeur dont le role est = 2 DISTINCT -->
            <?php
            $requeteProfesseur = "SELECT * FROM user WHERE ext_role=2";
            $stmtProfesseur = $db->prepare($requeteProfesseur);
            $stmtProfesseur->execute();
            $resultsProfesseur = $stmtProfesseur->fetchall(PDO::FETCH_ASSOC);
            ?>
            <div>
            <label for="professeur">
                Le professeur<span class="red">*</span> :
            </label>

            <select name="professeur" id="professeur" required>
                <?php foreach ($resultsProfesseur as $row) {

                    ?>
                    <option value="<?= $row["id_user"] ?>">
                        <?= $row["user_prenom"] . " " . $row["user_nom"] ?>
                    </option>
                <?php } ?>
            </select>
            </div>


         

            <div>
            <label for="coef">
                Coefficient<span class="red">*</span> :
            </label><br>
            <input type="number" name="coef" id="coef" required min="1">
            </div>


            <br><br>
            <div class="div_input"><input class="submit-button" type=submit value="Valider votre inscription"></div>
            </div>
            </div>
        </form>
        <br><br>
    </main>


</body>

</html>