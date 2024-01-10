<?php
include('connexion.php');
session_start();


if (isset($_FILES['file'])) { // Check if the form is submitted
    $idProjet = $_POST['id_projet'];
    $nameProjet = $_POST['title_projet'];

    $student_name = $_POST['student_name'];

    $content_dir = './projet/';
    $user_id = $_SESSION["id_user"];

    $user_dir = $content_dir .'/'.  $idProjet .'/';
    $tmp_file = $_FILES['file']['tmp_name'];

    if (!is_uploaded_file($tmp_file)) {
        $message= "Le fichier est introuvable. <br> Vous serez redirigé(e) vers la page du projet dans 5 secondes.";
        header("Refresh: 5; URL=" . $_SERVER['HTTP_REFERER']);
    }

    if (!file_exists($user_dir)) {
        if (!mkdir($user_dir, 0777, true)) {
            $message="Impossible de créer le répertoire utilisateur.  <br> Vous serez redirigé(e) vers la page du projet dans 5 secondes.";
            header("Refresh: 5; URL=" . $_SERVER['HTTP_REFERER']);
        }
    }
 

    $original_name = $_FILES['file']['name'];
    $file_extension = pathinfo($original_name, PATHINFO_EXTENSION);

    // Create a new filename based on the current timestamp
    $new_filename = $nameProjet . '_' .  $student_name . '.' . $file_extension;

    $destination = $user_dir . $new_filename;

    if (!move_uploaded_file($tmp_file, $destination)) {
        $message="Impossible de copier le fichier dans $user_dir.  <br> Vous serez redirigé(e) vers la page du projet dans 5 secondes.";
        header("Refresh: 5; URL=" . $_SERVER['HTTP_REFERER']);
    }

    $message= "Le fichier a bien été uploadé.  <br> Vous serez redirigé(e) vers la page du projet dans 5 secondes.";
    header("Refresh: 5; URL=" . $_SERVER['HTTP_REFERER']);
}

 

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
    <title>Projet</title>

    <style>
        .main {
            width: 100%;
            height: 90%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .message {
            text-align: center;
            font-size: 1.3rem;
            display: block;
            height: 10%;

        }
    </style>
</head>

<body>

    <main>
    

       
            <?php
            include('nav.php');
            
            ?>
            
            
            <div class="main">
            <div class="message">
            <?php echo $message; ?>
        </div>





 




</div>
</main>


</body>

</html>





