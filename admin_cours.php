<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&family=Lusitana:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_de_base.css">
    <link rel="stylesheet" href="admin_page.css">
    <title>Ajouter un cours</title>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.3/dist/flatpickr.min.js"></script>





    <style>
        .col-wrapper {
            display: block;
            /* height: 30vh; */
            display: flex;
            /* gap: 5px; */
            justify-content: center;
            flex-wrap: wrap;
            
        }

        .col {
            width: 20vw;
            min-width: 100px;
            /* background-color: var(--grey); */
            margin-inline: 10px;
        }
        .wrapper {
            width: 80%;
            text-align: center;

            display: flex;
            justify-content: center;
            margin: auto;
        }


        .col-wrapper>a {
            display: block;
            border-radius: 5px;
            padding: 20px 25px;
            background-color: var(--yellow1);
            color: black;
            font-weight: bolder;
            text-decoration: none;
            font-size: 1.8rem;
            margin: 0 5px;
            margin: 5px;


        }

        @media (max-width: 900px) {
            main {
                background-color: white;
                padding: 15px;
            }


            .col-wrapper>a {

                padding: 15px 20px;
                background-color: var(--yellow1);
                color: black;
                font-weight: bolder;
                text-decoration: none;
                font-size: 1.3rem;
                margin: 3px 3px;


            }
        }
    </style>
</head>

<body>

    <main>


        <?php


        session_start();
        include('nav_admin.php');
        include('connexion.php');



        ?>

        <h1>Choisissez le groupe</h1>
        <div class="wrapper">


            <div class="col">
                <h2>MMI1</h2>
                <div class="col-wrapper">
                    <a href="admin_cours_groupe.php?programme=MMI1&groupe=A">TP A</a>
                    <a href="admin_cours_groupe.php?programme=MMI1&groupe=B">TP B</a>
                    <a href="admin_cours_groupe.php?programme=MMI1&groupe=C">TP C</a>
                    <a href="admin_cours_groupe.php?programme=MMI1&groupe=D">TP D</a>
                </div>
            </div>
       


        <div class="col">
            <h2>MMI2</h2>
            <div class="col-wrapper">
                <a href="admin_cours_groupe.php?programme=MMI2&groupe=A">TP A</a>
                <a href="admin_cours_groupe.php?programme=MMI2&groupe=B">TP B</a>
                <a href="admin_cours_groupe.php?programme=MMI2&groupe=C">TP C</a>
                <a href="admin_cours_groupe.php?programme=MMI2&groupe=D">TP D</a>
            </div>
        </div>

        <div class="col">
            <h2>MMI3</h2>
            <div class="col-wrapper">
                <a href="admin_cours_groupe.php?programme=MMI1&groupe=A">TP A</a>
                <a href="admin_cours_groupe.php?programme=MMI3&groupe=B">TP B</a>
                <a href="admin_cours_groupe.php?programme=MMI3&groupe=C">TP C</a>
                <a href="admin_cours_groupe.php?programme=MMI3&groupe=D">TP D</a>
            </div>
        </div>



        </div>



    </main>


</body>

</html>