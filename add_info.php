<?php
include('connexion_offline.php');
session_start();

$title = $_POST['title'];
$text = $_POST['text'];
$matiereId = $_POST['matiere']; 
$currentDateTime = date('Y-m-d');

try {
    $insertQuery = "INSERT INTO info_matiere (info_titre, information, info_date, ext_matiere) VALUES (:title, :text, :currentDateTime, :matiereId)";
    $insertStatement = $db->prepare($insertQuery);
    $insertStatement->bindParam(':title', $title, PDO::PARAM_STR);
    $insertStatement->bindParam(':text', $text, PDO::PARAM_STR);
    $insertStatement->bindParam(':matiereId', $matiereId, PDO::PARAM_INT);
    $insertStatement->bindParam(':currentDateTime', $currentDateTime, PDO::PARAM_STR);
    $insertStatement->execute();

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} catch (PDOException $e) {
 
    echo "Error: " . $e->getMessage();
    
    exit;  
}
?>
