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
                <figure>
                    <img src="./img/campus/crous.png" alt="">
                    <figcaption>Restaurant CROUS</figcaption>
                </figure>
                <figure>
                    <img src="./img/campus/sport.png" alt="">
                    <figcaption>Gymnase et stade</figcaption>
                </figure>
                <figure>
                    <img src="./img/campus/bibliotheque.png" alt="">
                    <figcaption>Bibliothèque</figcaption>
                </figure>
            </div>
        </div>
    </main>


</body>

</html>