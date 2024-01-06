<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&family=Lusitana:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_de_base.css">
    <link rel="stylesheet" href="application.css">
    <title>Vos Applications</title>
</head>
<body>
<main>
    <?php
        session_start();
        include('nav.php');
        include('connexion.php');
        ?>

<div class="bloc_general">
<div class="bloc_general1">
    
    <div class="bloc_appli">
        <h1>Stockage</h1>
        <div class="appli">
            <a href="">File Transfert</a>
            <a href="">Drive</a>
        </div>
    </div>

    <div class="bloc_appli2">
        <h1>Développement</h1>
        <div class="appli">
            <a href="">O2 Switch</a>
            <a href="">GitHub</a>
        </div>
    </div>


</div>


<div class="bloc_general1">
    
    <div class="bloc_appli">
        <h1 class="titre2">Création</h1>
        <div class="appli">
            <a href="">Creative Cloud</a>
            <a href="">Media Coder</a>
            <a href="">Figma</a>
            <a href="">Canva</a>
        </div>
    </div>

    <div class="bloc_appli2">
        <h1 class="titre2">Communication</h1>
        <div class="appli pls">
            <a href="">Zoom</a>
            <a href="">Notion</a>
            <a href="">Miro</a>
        </div>
    </div>


</div>







</div>


</main>
</body>
</html>