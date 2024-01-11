<?php
include('connexion.php');
session_start();

$time_start = $_POST['time-start'];
$time_finish = $_POST['time-finish'];
$salle = $_POST['salle']; 
$matiere = $_POST['matiere']; 
$groupe = $_POST['groupe']; 
$date = $_POST['date']; 

 
 
$dateTimeStart = $date . ' ' . $time_start;
$dateTimeEnd = $date . ' ' . $time_finish;

// Format the combined datetime string to match the MySQL DATETIME format
$formatStart = date("Y-m-d H:i:s", strtotime($dateTimeStart));
$formatEnd = date("Y-m-d H:i:s", strtotime($dateTimeEnd));

 

try {
    $insertQuery = "INSERT INTO cours VALUES (NULL, :time_start, :time_finish, :salle, :matiere, :groupe, NULL)";
    $insertStatement = $db->prepare($insertQuery);
    $insertStatement->bindParam(':time_start', $formatStart, PDO::PARAM_STR);
    $insertStatement->bindParam(':time_finish', $formatEnd, PDO::PARAM_STR);
    $insertStatement->bindParam(':salle', $salle, PDO::PARAM_STR);
    $insertStatement->bindParam(':matiere', $matiere, PDO::PARAM_INT); 
    $insertStatement->bindParam(':groupe', $groupe, PDO::PARAM_STR); 
    $insertStatement->execute();

    $lastInsertedId = $db->lastInsertId();

     

header("Location: admin_cours.php");
 
    exit;
    
} catch (PDOException $e) {
 
    echo "Error: " . $e->getMessage();
    
    exit;  
}
?>
