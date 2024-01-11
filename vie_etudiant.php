<?php
session_start();
include('connexion.php');
?>
<?php if (isset($_SESSION["login"]) && ($_SESSION["role"]) == 1) { ?>

<?php session_start(); ?>
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
    <link rel="stylesheet" href="vie_etudiant.css">
    <title>Vie étudiante</title>


</head>

<body>

    <main>


        <?php
        if (isset($_SESSION["login"])) {
            include('nav.php');

            ?>

            <br><br><br>
            <div class="deux_bloc">
                <div class="bloc sante">
                    <a class="titre_bloc" href="">
                        <h2>Pôle santé</h2>
                    </a>
                    <ul>
                        <a href="">
                            <li>Pôle médical</li>
                        </a>
                        <a href="">
                            <li>Pôle handicap</li>
                        </a>
                        <a href="">
                            <li>Action sociale</li>
                        </a>
                        <a href="">
                            <li>Dispositifs d'aide et de soutien</li>
                        </a>
                    </ul>
                </div>

                <div class="bloc pratique">
                    <a class="titre_bloc" href="">
                        <h2>Vie pratique</h2>
                    </a>
                    <ul>
                        <a href="">
                            <li>Restauration</li>
                        </a>
                        <a href="">
                            <li>Logement</li>
                        </a>
                        <a href="">
                            <li>Bibliothèques</li>
                        </a>
                        <a href="">
                            <li>Contacts</li>
                        </a>
                        <a href="">
                            <li>Accès aux campus</li>
                        </a>
                    </ul>
                </div>
            </div>

            <br><br><br>

            <div class="deux_bloc">
                <div class="bloc formation">
                    <a class="titre_bloc" href="">
                        <h2>Formation</h2>
                    </a>
                    <ul>
                        <a href="">
                            <li>Enseignements transversaux</li>
                        </a>
                        <a href="">
                            <li>Orientation, Insertion professionnelle et Entrepreneuriat</li>
                        </a>
                        <a href="">
                            <li>Diplômes</li>
                        </a>
                        <a href="">
                            <li>OFIPE</li>
                        </a>
                    </ul>
                </div>

                <div class="bloc campus">
                    <a class="titre_bloc" href="">
                        <h2>Vie de campus</h2>
                    </a>
                    <ul>
                        <a href="">
                            <li>Vie associative</li>
                        </a>
                        <a href="">
                            <li>Vie citoyenne</li>
                        </a>
                        <a href="">
                            <li>Elections universitaires 2023</li>
                        </a>
                        <a href="">
                            <li>Sport</li>
                        </a>
                        <a href="">
                            <li>Arts et Culture</li>
                        </a>
                        <a href="">
                            <li>Engagements responsables</li>
                        </a>
                        <a href="">
                            <li>En savoir + sur votre université</li>
                        </a>
                    </ul>
                </div>
            </div>

            <br><br><br>

            <div class="deux_bloc">
                <div class="bloc informatique">
                    <a class="titre_bloc" href="">
                        <h2>Informatique et numérique</h2>
                    </a>
                    <ul>
                        <a href="">
                            <li>Charte informatique</li>
                        </a>
                        <a href="">
                            <li>Compte informatique</li>
                        </a>
                        <a href="">
                            <li>Messagerie universitaire</li>
                        </a>
                        <a href="">
                            <li>WiFi</li>
                        </a>
                        <a href="">
                            <li>Ressources informatiques</li>
                        </a>
                        <a href="">
                            <li>Contacts et demandes</li>
                        </a>
                    </ul>
                </div>

                <div class="bloc international">
                    <a class="titre_bloc" href="">
                        <h2>International</h2>
                    </a>
                    <ul>
                        <a href="">
                            <li>Partir à l'étranger</li>
                        </a>
                        <a href="">
                            <li>International students</li>
                        </a>
                        <a href="">
                            <li>Parrainage International</li>
                        </a>
                        <a href="">
                            <li>Cours de Français</li>
                        </a>
                    </ul>
                </div>
            </div>
            <br><br><br>
        </main>



    <?php } else {
            header("location:login.php?errConnexion");
        } ?>
</body>

</html>
<?php } else {
            header("location:login.php?errConnexion");
        } ?>