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
    <title>ENT Enseignant - Université Gustave Eiffel</title>


</head>

<body>

    <main>


        <?php


        include('nav-teacher.php');
        $_SESSION['id_user'] = 3;
        $prof = $_SESSION['id_user'];

          ?>

          <style> 
        .big-wrapper {
            padding: 30px 0;
            margin: 0 35% ;
        }

        textarea {height: 10vh;
        }

        .submit {
            background-color: var(--red);
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    font-size: 1.1rem;
        }
            
            </style>

<div class="big-wrapper">
    <h1>Ajouter un projet</h1>

    <div class="fields">




<form action="add_projet.php" method="POST" enctype="multipart/form-data">
    
    <label for="title"> Titre: <input type="text" id="title" name="title"></label>
    <br><br>
    
<?php 
    $_SESSION['id_user'] = 3;
    $requete2 = "SELECT DISTINCT *
         FROM matiere 
WHERE   ext_prof = :prof ";


        $stmt2 = $db->prepare($requete2);
        $stmt2->bindValue(':prof', $prof, PDO::PARAM_INT);
        $stmt2->execute();
        $matiere = $stmt2->fetchAll(PDO::FETCH_ASSOC);


?>
            <label for="matiere">Matiere:  </label>
    <select name="matiere" id="matiere">

    <?php foreach ($matiere as $onem) : ?>
        <option value="<?= $onem['id_matiere']   ?>"><?= $onem['nom_matiere']   ?></option>
                             
                           
                    <?php endforeach; ?>
       
    </select>
    
    
    <br><br>
    <label for="deadline">Deadline:  <input id="deadline" name="deadline" type="datetime-local"></label>
    <br><br>
    
    <label for="coef"> Coefficient: <input type="number" id="coef" name="coef"></label>
    <br><br>
    
    <label for="desc"> Description: <textarea  id="desc" name="desc"></textarea></label>
    <br><br>
<label for="file">Consignes (pas obligatoire): </label> <br><br>
    <input type="file" name="file" id="file">
<br><br><br>
    <input type="submit" value="Ajouter" class="submit">
</form>


    </div>
</div>




    </main>


</body>

</html>