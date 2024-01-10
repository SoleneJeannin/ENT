<?php
include('connexion_offline.php');
session_start();

$id_cours = $_POST['cours'];
$coef = $_POST['coef'];
$desc = $_POST['desc']; 
$title = $_POST['title']; 
 

 

try {
    $insertQuery = "INSERT INTO eval_exam VALUES (NULL, :coef, :id, :title, :desc, 1)";
    $insertStatement = $db->prepare($insertQuery);
    $insertStatement->bindParam(':coef', $coef, PDO::PARAM_INT);
    $insertStatement->bindParam(':id', $id_cours, PDO::PARAM_INT);
    $insertStatement->bindParam(':title', $title, PDO::PARAM_STR); 
    $insertStatement->bindParam(':desc', $desc, PDO::PARAM_STR); 
    $insertStatement->execute();

    $lastInsertedId = $db->lastInsertId();

    
    $insertQuery2 = "UPDATE cours
    SET exam = 1
    WHERE id_cours = :id_cours";   
$insertStatement2 = $db->prepare($insertQuery2);
$insertStatement2->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);   
$insertStatement2->execute();


header("Location: teacher_exam.php?id_exam=$lastInsertedId");
 
    exit;
    
} catch (PDOException $e) {
 
    echo "Error: " . $e->getMessage();
    
    exit;  
}
?>
