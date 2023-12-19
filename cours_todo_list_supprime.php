<?php
include('connexion.php');
session_start();

if (isset($_SESSION["login"])) {
    if (isset($_GET["idTodo"])) {
        $requeteSupprimerTodo = "DELETE FROM todo_list WHERE id_todo_list=:idTodoList";
        $stmt4 = $db->prepare($requeteSupprimerTodo);
        $stmt4->bindParam(':idTodoList', $_GET["idTodo"], PDO::PARAM_INT);
        $stmt4->execute();
    }
    header("Location: cours_todo_list.php");
} else {
    echo "Vous n'êtes pas autorisé à rester sur cette page";
}
?>