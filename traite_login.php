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

        $_SESSION["login"] = $result["user_login"];
        header("Location: index.php");
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