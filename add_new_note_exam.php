<?php
include('connexion_offline.php');
session_start();

$id_exam = $_POST['id_exam'];
$comment = $_POST['comment'];
$note = $_POST['note']; 
$note = $_POST['note']; 
$student = $_POST['selectedStudent'];

 

try {
    $insertQuery = "INSERT INTO note_exam VALUES (:student, :exam, :note, :comment, NULL)";
    $insertStatement = $db->prepare($insertQuery);
    $insertStatement->bindParam(':student', $student, PDO::PARAM_INT);
    $insertStatement->bindParam(':exam', $id_exam, PDO::PARAM_INT);
    $insertStatement->bindParam(':note', $note, PDO::PARAM_INT);
    $insertStatement->bindParam(':comment', $comment, PDO::PARAM_STR);
    $insertStatement->execute();

   
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} catch (PDOException $e) {
 
    echo "Error: " . $e->getMessage();
    
    exit;  
}
?>
