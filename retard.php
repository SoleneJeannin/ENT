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
    <link rel="stylesheet" href="retard.css">
    <title>Document, retard, absence</title>


</head>

<body>

    <main>


        <?php
        session_start();
        include('nav.php');
        include('connexion.php');

        //Récupération de l'utilisateur
        $stmt = $db->query("SELECT * FROM user WHERE user_login = '" . $_SESSION['login'] . "'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id_user'] = $result['id_user'];
        ?>


        <h1>Mes documents</h1>
        <div class="bloc_document">
            <div class="first_colonne">
                <a href="./document/étudiants/<?= $_SESSION['id_user'] ?>/certificat_sco.pdf"
                    class="lien_document">Certificat de scolarité</a>
                <a href="./document/étudiants/<?= $_SESSION['id_user'] ?>/bourse.pdf" class="lien_document">Notification
                    conditionnelle de bourse</a>
                <a href="./document/étudiants/<?= $_SESSION['id_user'] ?>carte_etu.pdf" class="lien_document">Carte
                    étudiant éléctronique</a>
            </div>

            <div class="ligne"></div>
            <div class="second_colonne">
                <a href="./document/étudiants/<?= $_SESSION['id_user'] ?>/stage1.pdf" class="lien_document">Contrat de
                    stage (2e semestre)</a>
                <a href="./document/étudiants/<?= $_SESSION['id_user'] ?>/stage2.pdf" class="lien_document">Contrat de
                    stage (4e semestre)</a>
                <a href="./document/étudiants/<?= $_SESSION['id_user'] ?>/alternance.pdf" class="lien_document">Contrat
                    d'alternance</a>
            </div>
        </div>
        <br>
        <div>
            <p>Retards :
                <?= $result['user_retard'] ?> minutes
            </p>

            <?php
            //Récupérer les absences de l'utilisateur
            $id_user = $_SESSION['id_user'];

            $stmt2 = $db->query("SELECT * FROM absence WHERE ext_etudiant = '" . $id_user . "'");
            $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            $abs_justif = 0;
            $abs_non_justif = 0;
            foreach ($result2 as $row) {
                //Si le champ "jusitifcation" n'est pas vide (que l'absence est justifiée)
                if (isset($row['abs_justificatif'])) {
                    //Additionner toutes les absences
                    $abs_justif = $abs_justif + $row['abs_duree'];
                }
                //Si le champ "jusitifcation" vaut "NULL" (que l'absence est NON justifiée)
                else {
                    $abs_non_justif = $abs_non_justif + $row['abs_duree'];
                }
            }

            ?>
            <p>Absences :
                <?= $abs_justif ?> heure(s) justifiée(s) et
                <?= $abs_non_justif ?> heure(s) non justifiée(s)
            </p>

        </div>

        <br><br>

        <p class="info">Si vous avez des questions sur vos démarches administratives, vous pouvez vous adresser à votre
            responsable pédagogique : Sophie DAVID</p>
    </main>


</body>

</html>