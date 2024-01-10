<?php
session_start();
include('connexion.php');



if (isset($_GET['todoId']) && isset($_GET['isChecked'])) {
    $isChecked = $_GET['isChecked'] === 'true' ? 1 : 0;
    $todoId = $_GET['todoId'];


    // Mettre à jour la base de données en fonction de l'état de la checkbox
    $checkboxUpdate = "UPDATE todo_list SET todo_list_status = :isChecked WHERE id_todo_list = :todoId";

    $stmt = $db->prepare($checkboxUpdate);
    $stmt->bindParam(':isChecked', $isChecked, PDO::PARAM_INT);
    $stmt->bindParam(':todoId', $todoId, PDO::PARAM_INT);
    $stmt->execute();
}
?>