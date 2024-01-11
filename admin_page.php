<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&family=Lusitana:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style_de_base.css">
    <link rel="stylesheet" href="admin_page.css">
    <title>Accueil Administrateur</title>


</head>

<body>

    <main>


        <?php


        session_start();
        include('nav_admin.php');
        include('connexion.php');

        $idUser = $_SESSION['id_user'];
        $requeteInscrit = "SELECT * FROM user ORDER BY ext_role";
        $stmtInscrit = $db->prepare($requeteInscrit);
        $stmtInscrit->execute();
        $resultsInscrit = $stmtInscrit->fetchall(PDO::FETCH_ASSOC);

        ?>

        <h1>Côté administratif</h1>
        <h2>Les étudiants inscrits</h2>
        <?php if (isset($_GET["suppOk"])) {
            ?>
            <p class="suppOk">Vous avez bien supprimer cet utilisateur</p>
        <?php } ?>
        <?php if (isset($_GET["suppNon"])) {
            ?>
            <p>Un problème est survenu lors de la suppression de l'utilisateur</p>
        <?php } ?>
        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th class="phone-photo">Photos</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Formation</th>
                    <th>Groupe</th>
                    <th>Rôle</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultsInscrit as $row) {
                    $requeteNomRole = "SELECT role_titre FROM role WHERE id_role=:ext_role";
                    $stmtNomRole = $db->prepare($requeteNomRole);
                    $stmtNomRole->bindParam(':ext_role', $row["ext_role"], PDO::PARAM_INT);
                    $stmtNomRole->execute();
                    $resultsNomRole = $stmtNomRole->fetch(PDO::FETCH_ASSOC);

                    ?>
                    <tr class=<?php
                    if (isset($row["ext_role"])) {
                        if ($row["ext_role"] == 1) {
                            echo "student";
                        } elseif ($row["ext_role"] == 2) {
                            echo "prof";
                        } elseif ($row["ext_role"] == 3) {
                            echo "admin";
                        }
                    }
                    ?>>
                        <td>
                            <?= $row["id_user"] ?>
                        </td>
                        <td class="phone-photo"><img class="photo" src="./img/etudiants-card/<?= $row["user_photo"] ?>"
                                alt=""></td>
                        <td>
                            <?= ucfirst($row["user_prenom"]) ?>
                        </td>
                        <td>
                            <?= ucfirst($row["user_nom"]) ?>
                        </td>
                        <td>
                            <?= $row["formation"] ?>
                        </td>
                        <td>
                            <?= $row["user_groupe"] ?>
                        </td>
                        <td>
                            <?= $resultsNomRole["role_titre"] ?>
                        </td>
                        <td>
                            <form class="form-supp" action="admin_page_supp.php" method="POST">
                                <input type="hidden" name="idUser" value="<?= $row["id_user"] ?>">
                                <input type="hidden" name="extRole" value="<?= $row["ext_role"] ?>">
                                <input class="supp" type="submit" value="Supprimer">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php

        ?>

    </main>


</body>

</html>