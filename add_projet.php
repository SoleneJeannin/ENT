<?php
// Connect to the database
include('connexion.php');
session_start();

 
 
 
    // Get the form data
    $title = $_POST['title'];
    $matiere = $_POST['matiere'];
    $coef = $_POST['coef'];
    $desc = $_POST['desc'];
    $deadline = $_POST['deadline'];

 
        $insertQuery = "INSERT INTO eval_projet VALUES (NULL, :matiere, CURRENT_TIMESTAMP, :end, :coef, :title, :desc, 2, NULL)";
        $insertStatement = $db->prepare($insertQuery);
        $insertStatement->bindParam(':matiere', $matiere, PDO::PARAM_STR);
        $insertStatement->bindParam(':end', $deadline, PDO::PARAM_STR);
        $insertStatement->bindParam(':coef', $coef, PDO::PARAM_INT);
        $insertStatement->bindParam(':title', $title, PDO::PARAM_STR);
        $insertStatement->bindParam(':desc', $desc, PDO::PARAM_STR);
        $insertStatement->execute();

        $lastInsertedId = $db->lastInsertId();

        if (isset($_FILES['file'])) { // Check if the form is submitted
             
            $content_dir = './projet/';
         
        $newway = 'consignes';

            $user_dir = './projet/'.  $lastInsertedId .'/'.  $newway  .'/';

            $tmp_file = $_FILES['file']['tmp_name'];
        
            if (!is_uploaded_file($tmp_file)) {
                $message= "Le fichier est introuvable. <br> Vous serez redirigé(e) vers la page du projet dans 5 secondes.";
                header("Location: teacher_projet.php?id_projet=$lastInsertedId");

            }
        
            if (!file_exists($user_dir)) {
                if (!mkdir($user_dir, 0777, true)) {
                    $message="Impossible de créer le répertoire utilisateur.  <br> Vous serez redirigé(e) vers la page du projet dans 5 secondes.";
                    header("Location: teacher_projet.php?id_projet=$lastInsertedId");
                }
            }
         
        
            $original_name = $_FILES['file']['name'];
            $file_extension = pathinfo($original_name, PATHINFO_EXTENSION);
        
            // Create a new filename based on the current timestamp
            
            $destination = $user_dir .    $original_name ;


if ($original_name != "") {
            $insertQuery2 = "UPDATE eval_projet
            SET consignes_projet = :original_name
            WHERE id_eval_projet = :lastInsertedId";
$insertStatement2 = $db->prepare($insertQuery2);
$insertStatement2->bindParam(':original_name', $original_name, PDO::PARAM_STR);
$insertStatement2->bindParam(':lastInsertedId', $lastInsertedId, PDO::PARAM_INT);
$insertStatement2->execute();
};

            if (!move_uploaded_file($tmp_file, $destination)) {
                $message="Impossible de copier le fichier dans $user_dir.  <br> Vous serez redirigé(e) vers la page du projet dans 5 secondes.";
                header("Location: teacher_projet.php?id_projet=$lastInsertedId");
            }
        
            $message= "Le fichier a bien été uploadé.  <br> Vous serez redirigé(e) vers la page du projet dans 5 secondes.";
            header("Location: teacher_projet.php?id_projet=$lastInsertedId");
        };
?>
