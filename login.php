<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connexion</title>
</head>
<body>
    <h1>Université Gustave Eiffel</h1>
    <p>Accédez à votre interface, et retrouvez toutes les informations dont vous avez besoin : emploi du temps, notes, papiers administratifs, mails, applications, vie universitaire...</p>

    <div>
        <img src="" alt="">
        <form action="traite_login.php" method="POST">
            <label for="login">Login : </label> <br>
            <input type="text" id="login" name="login">
            <br> <br>
            <label for="mdp">Mot de passe : </label> <br>
            <input type="password" id="mdp" name="mdp">
            <br> <br>
            <input type="submit" name="connexion_user" value="Se connecter">
        </form>
    </div>
</body>
</html>