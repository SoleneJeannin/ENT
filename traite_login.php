<?php

include("connexion.php");

$loginToCheck = $_POST["login"];
$mdpToCheck = $_POST["mdp"];

$requete = "SELECT * FROM user WHERE user_login = :login";
$stmt = $db->prepare($requete);
$stmt->bindValue(':login', $loginToCheck, PDO::PARAM_STR);
$stmt->execute();



if ($stmt->rowcount() == 1) {
    $result = $stmt->fetch();
    $hash = $result['user_mdp'];

    if (password_verify($mdpToCheck, $hash)) {
        session_start();
        $_SESSION["login"] = $result["user_login"];
        $_SESSION['id_user'] = $result['id_user'];
        $_SESSION['programme_user'] = $result['user_programme'];
        $_SESSION['groupe_user'] = $result['user_groupe'];
        $_SESSION['user_nom'] = $result['user_nom'];
        $_SESSION['user_prenom'] = $result['user_prenom'];
        $_SESSION['role'] = $result['ext_role'];

if ($result['ext_role']== 1) {
    header("Location: index.php");
}
if ($result['ext_role']== 2) {
    header("Location: teacher_page.php");
}

if ($result['ext_role']== 3) {
    header("Location: admin_page.php");
}
        
    } else {
        header("Location: login.php?err=mdp");
        session_destroy();
        $_SESSION = array();
    }

} else {
    header("Location: login.php?err=login");
    session_destroy();
    $_SESSION = NULL;
}
;
?>