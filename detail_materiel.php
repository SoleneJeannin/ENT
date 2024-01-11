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
    <link rel="stylesheet" href="detail_materiel.css">
    <title>Réservation - matériel</title>


</head>

<body>

    <main>
        <!--En cas de problème dans le formulaire-->
        <?php
        if (isset($_GET['err'])) {
            echo 'Vous devez lire et accepter les règles d\'utilisation';
        }
        ?>

        <?php
        session_start();
        if (isset($_SESSION["login"])) {
            include('nav.php');
            include('connexion.php');


            ?>
            <br>
            <?php

            $materiel_res = $_GET["id"];
            $stmt = $db->query("SELECT * FROM materiel WHERE id_materiel= '$materiel_res'");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['stock'] > 0) { ?>

                <!--Materiel selectionné à la page "reservation_materiel-->
                <div class="bloc_general">
                    <div class="titre_descr">
                        <h2 class="titre">
                            <?= $result['materiel_titre'] ?>
                        </h2>

                        <!--Description-->
                        <?= $result['description'] ?>

                        <!--Affiche le bouton de téléchargement de la notice (si il y en a une)-->
                        <?php if ($result['notice'] != '') { ?>
                            <div class="div_lien"><a class="notice" href="./document/notices/<?= $result['notice'] ?>">Télécharger la
                                    notice</a></div>
                        <?php } else {
                            echo '';
                        }
            } else {
                echo "Ce materiel n'est plus disponible ! Revenez quand il y en aura de nouveau en réserve.";
            }
            ?>
                </div>

                <!--Image-->
                <?= $result['image'] ?>
            </div>

            <br><br><br>

            <!--Formulaire de réservation-->
            <form action="traite_reservation.php?id=<?= $result['id_materiel'] ?>" method="POST">
                <input type="hidden" name="id_materiel" value="<?= $result['id_materiel'] ?>">
                <p class="titre_date">Date de réservation</p>
                <div>
                    <label for="debut">début : </label>
                    <input type="date" id="debut" name="debut">
                </div>

                <br>

                <div>
                    <label for="fin">fin : </label>
                    <input type="date" id="fin" name="fin">
                </div>

                <br><br>

                <div>
                    <input type="radio" id="conditions" name="conditions" value="conditions" />
                    <label for="conditions">En cochant cette case, j’accepte <a href="./document/regles_utilisation">les
                            règles d’utilisation</a></label>
                </div>
                <br><br>
                <div>
                    <input class="reserver" type="submit" name="reservation" value="Réserver">
                </div>
            </form>

            <br><br>
        <?php } else {
            header("location:login.php?errConnexion");
        } ?>
    </main>


</body>

</html>