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
    <link rel="stylesheet" href="style_de base.css">
    <link rel="stylesheet" href="login.css">
    <title>Connexion - login</title>


</head>

<body>

    <main>

        <div class="login">
            <div class="entete-login">
                <!-- <h1>Université Gustave Eiffel</h1> -->
                <h1><img src="./img/connexion/Logo-universite.png" alt=""></h1>
                <p>Accédez à votre interface, et retrouvez toutes les informations dont vous avez besoin</p>
            </div>

            <div class="connexion">
                <img src="" alt="">
                <form action="traite_login.php" method="POST">
                    <label for="login">Login : </label> <br>
                    <input type="text" id="login" name="login" placeholder="Adresse mail universitaire">
                    <br> <br>
                    <label for="mdp">Mot de passe : </label> <br>
                    <input type="password" id="mdp" name="mdp" placeholder="Mot de passe">
                    <br> <br>
                    <button type="submit" name="connexion_user" >Connexion</button>
                </form>
            </div>
        </div>

    </main>


</body>

</html>