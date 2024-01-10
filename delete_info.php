<?php
include('connexion.php');
session_start();



$info = $_GET['id_info'];

$delete = "DELETE FROM info_matiere WHERE id_info = :info";
        $stmt = $db->prepare($delete);
        $stmt->bindValue(':info', $info, PDO::PARAM_INT);
        $stmt->execute();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
 
?>