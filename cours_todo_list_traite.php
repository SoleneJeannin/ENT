
<?php
session_start();
include('connexion.php');
// On regarde si une personne est connecter

if (isset($_SESSION["login"])) {
    echo 'connecté';
    if (isset($_GET["writetodo"])){
        
        $todoText = $_GET['writetodo'];
        $idUser = $_SESSION['id_user'];

        $insereTodo = "INSERT INTO todo_list VALUES (NULL,:todo_list_text,NULL,:ext_user)";
        $stmt = $db->prepare($insereTodo);

        $stmt->bindParam(':todo_list_text', $todoText, PDO::PARAM_STR);
        $stmt->bindParam(':ext_user', $idUser, PDO::PARAM_INT);
        $stmt -> execute();

        header("Location: cours_todo_list.php");
    }
}

else{
    echo "Vous n'êtes pas connecté";
}

?>