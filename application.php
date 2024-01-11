<?php
        session_start();
      
        include('connexion.php');
    
      if (isset($_SESSION["login"]) && ($_SESSION["role"]) == 1) { ?>
            


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
    <link rel="stylesheet" href="application.css">
    <title>Vos Applications</title>
</head>

<body>
    <main>
        <?php
      
        include('nav.php');
   
       
            ?>

            <div class="bloc_general">
                <div class="bloc_general1">

                    <div class="bloc_appli">
                        <h1 class="titre0">Stockage</h1>
                        <div class="appli">
                            <a href="https://filesender.renater.fr/?s=guests">File Transfert</a>
                            <a href="https://drive.google.com/drive/my-drive?hl=fr">Drive</a>
                        </div>
                    </div>

                    <div class="bloc_appli2">
                        <h1 class="titre1">Développement</h1>
                        <div class="appli">
                            <a href="https://www.o2switch.fr/">O2 Switch</a>
                            <a href="https://github.com/">GitHub</a>
                        </div>
                    </div>


                </div>


                <div class="bloc_general1">

                    <div class="bloc_appli">
                        <h1 class="titre3">Création</h1>
                        <div class="appli">
                            <a href="https://creativecloud.adobe.com/fr">Creative Cloud</a>
                            <a href="https://www.mediacoderhq.com/">Media Coder</a>
                            <a href="https://www.figma.com/">Figma</a>
                            <a href="https://www.canva.com/">Canva</a>
                        </div>
                    </div>

                    <div class="bloc_appli2">
                        <h1 class="titre4">Communication</h1>
                        <div class="appli">
                            <a href="https://zoom.us/fr/signin">Zoom</a>
                            <a href="https://www.notion.so/fr-fr">Notion</a>
                            <a href="https://miro.com/fr/">Miro</a>
                        </div>
                    </div>


                </div>







            </div>
        <?php } else {
            header("location:login.php?errConnexion");
        }
        ?>

    </main>
</body>

</html>