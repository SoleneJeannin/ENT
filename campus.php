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
        <link rel="stylesheet" href="campus.css">
    <title>Campus</title>

    
</head>

<body>

    <main>
        <?php
        session_start();
        include('nav.php');
        include('connexion.php');
        ?>

        <h1>Votre Campus</h1>
        <div class="carte" >
            <img src="./img/campus/carte.png" alt="carte du campus" class="img_carte">

            <div class="legende">
                <h2>Légende</h2>

                <div class="bloc_logo">
                <figure>
                    <img class="etoile" src="./img/campus/crous.png" alt="">
                    <figcaption>Restaurant CROUS</figcaption>
                </figure>
                <figure>
                    <img class="carre" src="./img/campus/sport.png" alt="">
                    <figcaption>Gymnase et stade</figcaption>
                </figure>
                <figure>
                    <img class="etoile" src="./img/campus/bibliotheque.png" alt="">
                    <figcaption>Bibliothèque</figcaption>
                </figure>
                </div>
            </div>
        </div>
<br><br>
        <div class="bloc_description">
            <div class="texte">
                <h2>CROUS DE l’ESIEE</h2>
            <p>Le restaurant universitaire (RU)
D’une capacité de 550 élèves, le restaurant universitaire est ouvert uniquement le midi, du lundi au vendredi, de 11 h 30 à 14 h 00. Il est organisé selon différents pôles afin de proposer des plats variés : végétariens, pizzas, poissons, viandes…</p>
</div>
            <img class="esiee" src="./img/campus/esiee.jpg" alt="">



        </div>
    </main>


</body>

</html>