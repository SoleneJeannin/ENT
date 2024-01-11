<?php 
include('connexion.php');
 session_start() ?>

<?php if (isset($_SESSION["login"]) && ($_SESSION["role"]) == 2) { ?>
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
         include('nav-teacher.php');
        ?>



<div class="bloc_general">
    
    <div id="settingBloc" class="bloc_setting">
        <a class="nv_mess" href="">Nouveau message</a>
        <a class="first_list" href="">Boite de réception</a>
        <a href="">Messages suivis</a>
        <a href="">En attente</a>
        <a href="">Messages envoyés</a>
        <a href="">Brouillons</a>
        <a href="">Spam</a>
        <a href="">Corbeille</a>
        <a href="">Tous les messages</a>
    </div>


    <div class="bloc_mess">

        <div class="bloc_recherche">
            <div><img class="bouton_aff" src="./img/nav/menu.png" alt=""></div>
            <input type="search" placeholder="recherche...">
            <img class="img_loupe" src="./img/salle/loupe.png" alt="">
        </div>

        <div class="bloc_reception">

            <div class="affichage">
<!-- Le code en dessous c'est le code pour 1 mail-->
                <div class="mail">
                    <div class="bloc_right">
                    <div><div class="carre"> </div></div>
                        <a class="mail_sujet" href="">Présidence de l'Uni.</a> 
                        <a class="descr" href="">Voeux 2024</a> 
                    </div>

                    <div class="date">
                        <p>14:30</p>
                    </div>
                </div>
<!-- ---------------------------------------------- -->

<!-- 2e mail (le même code) placé dans la div class="bloc_reception":  -->
                <div class="mail">
                    <div class="bloc_right">
                    <div><div class="carre"> </div></div>
                        <a class="mail_sujet" href="">DAVID Sophie</a> 
                        <a class="descr" href="">Bonne fêtes !</a> 
                    </div>

                    <div class="date">
                        <p>20/12/2023</p>
                    </div>
                </div>

                <div class="mail">
                    <div class="bloc_right">
                    <div><div class="carre"> </div></div>
                        <a class="mail_sujet" href="">BERTHET Matthieu</a> 
                        <a class="descr" href="">Notes des tp test</a> 
                    </div>

                    <div class="date">
                        <p>19/12/2023</p>
                    </div>
                </div>
               
                <div class="mail">
                    <div class="bloc_right">
                        <div><div class="carre"> </div></div>
                        <a class="mail_sujet" href="">BISTER Florence</a> 
                        <a class="descr" href="">Suite à la seconde séance de TD </a> 
                    </div>

                    <div class="date">
                        <p>18/12/2023</p>
                    </div>
                </div>

                <div class="mail">
                    <div class="bloc_right">
                    <div><div class="carre"> </div></div>
                        <a class="mail_sujet" href="">Merci de ne pas répondre</a> 
                        <a class="descr" href="">Vous avez remis "meilleurs_notes-SAE ENT.pdf"»</a> 
                    </div>

                    <div class="date">
                        <p>14/12/2023</p>
                    </div>
                </div>




        </div>

    </div>


</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var contactImage = document.querySelector('.bouton_aff');
  var settingBloc = document.getElementById('settingBloc');
  var blocRec = document.querySelector('.bloc_reception');

  var isOpen = false; // Ajout d'une variable pour suivre l'état du pop-up

  contactImage.addEventListener('click', function() {
    if (isOpen) {
        settingBloc.style.display = 'none';
        blocRec.classList.remove('overlay');
    } else {
        settingBloc.style.display = 'flex';
        blocRec.classList.add('overlay');
    }

    isOpen = !isOpen; 
  });
});
</script>


    </main>
</body>

</html>

<?php } else {
    header("Location: login.php?errConnexion");
}; ?>