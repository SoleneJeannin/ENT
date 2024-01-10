<?php
include('connexion_offline.php');
session_start();

if (isset($_POST['fastAccess'])) {
    $id_access = $_GET['id'];

    $updateQuery = "UPDATE user SET user_acces_rapide" . $id_access . " = :selectedOption WHERE id_user = :userId";
    $updateStatement = $db->prepare($updateQuery);
    $updateStatement->bindParam(':selectedOption', $_POST['fastAccess'], PDO::PARAM_INT);
    $updateStatement->bindParam(':userId', $_SESSION['id_user'], PDO::PARAM_INT);

    $updateStatement->execute();
     }
      
        header("Location: ./index.php");
        exit();

        

?>
