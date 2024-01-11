<?php
include('connexion.php');
session_start();

$info = $_GET['id'];

$delete = "DELETE FROM cours WHERE id_cours = :info";
$stmt = $db->prepare($delete);
$stmt->bindValue(':info', $info, PDO::PARAM_INT);
$stmt->execute();



if (isset($_GET['exam'])) {
    $delete = "DELETE FROM eval_exam WHERE ext_cours = :info";
    $stmt = $db->prepare($delete);
    $stmt->bindValue(':info', $info, PDO::PARAM_INT);
    $stmt->execute();
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
