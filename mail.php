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
         <link rel="stylesheet" href="mail.css">
    <title>Mail</title>

    
</head>

<body>
    <main>
        <?php
         include('nav.php');
        ?>



<div class="bloc_general">
    
    <div class="bloc_setting">
        <p class="nv_mess">Nouveau message</p>
        <p class="first_list">Boite de réception</p>
        <p>Messages suivis</p>
        <p>En attente</p>
        <p>Messages envoyés</p>
        <p>Brouillons</p>
        <p>Spam</p>
        <p>Corbeille</p>
        <p>Tous les messages</p>
    </div>


    <div class="bloc_mess">

        <div class="bloc_recherche">
            <input type="search" placeholder="recherche...">
            <img class="img_loupe" src="./img/salle/loupe.png" alt="">
        </div>

        <div class="bloc_reception">

            <div class="affichage">

                <div class="bloc_right">
                    <div class="carre"> </div>
                    <p class="mail_sujet">Elementor</p>
                    <p class="descr">It's Black Friday Today !</p>
                </div>

                <div class="date">
                    <p>date</p>
                </div>

            </div>

        </div>

    </div>


</div>


    </main>
</body>

</html>