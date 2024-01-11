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
    <link rel="stylesheet" href="admin_page.css">
    <title>Ajouter un cours</title>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.3/dist/flatpickr.min.js"></script>


</head>

<body>

    <main>


        <?php


        session_start();
        include('nav_admin.php');
        include('connexion.php');

        

        ?>

        <h1>Ajouter un cours</h1>


<style> 
.programme {
    display: block;
    /* height: 30vh; */
    display: flex;
    justify-content: space-around;
}

.wrapper {
    width: 400px;
    text-align: center;

    margin: auto;
}

input, select {
    width: 100%;
    background-color: var(--grey);
    border: none;
    height: 40px;
    padding: 5px 10px;
    border-radius: 7px;
}

#sub {
    width: 30%;
    background-color: var(--red);
    cursor: pointer;
    margin-bottom: 40px;
}

.programme a {
    display: block;
    border-radius: 5px;
    padding: 20px 25px;
    background-color: var(--yellow1);
    color: black;
    font-weight: bolder;
    text-decoration: none;
    font-size: 1.8rem;
    margin: 0 5px;
    

}

@media (max-width: 900px) {
    main {background-color: white;
    padding: 15px;}

    
.programme a {
    
    padding: 20px 25px;
    background-color: var(--yellow1);
    color: black;
    font-weight: bolder;
    text-decoration: none;
    font-size: 1.5rem;
    margin: 0 5px;
    

}
}
 
</style>

        <div class="wrapper">




            <div class="programme">
                <a href="admin_add_cours.php?programme=MMI1">MMI1</a>
                <a href="admin_add_cours.php?programme=MMI2">MMI2</a>
                <a href="admin_add_cours.php?programme=MMI3">MMM3</a>
            </div>
            <br>
            <br>
            <form action="add_cours.php" method="POST">
                <span>S'il vous plait, choisissez l'heure entre 8:00 et 18:00 avec des minutes multiples de 15 :</span>
                <br><br>
                <label for="time-start">Le debut: </label>
                <input type="time" id="time-start" name="time-start" min="08:00" max="18:00" step="900" required>
                <br><br>
                <label for="time-finish">La fin: </label>
                <input type="time" id="time-finish" name="time-finish" min="08:00" max="18:00" step="900" required>
                <br><br>
                <label for="date">La date: </label>
                <input type="date" id="date" name="date" required>
                <br><br>
                <label for="salle">La salle: </label>
                <input type="text" id="salle" name="salle" required>
            
                <br><br>
            
                <?php


$prog = $_GET["programme"]?? "MMI";

    $requete2 = "SELECT *
         FROM matiere 
WHERE   programme = :prog ";


        $stmt2 = $db->prepare($requete2);
        $stmt2->bindValue(':prog', $prog, PDO::PARAM_STR);
        $stmt2->execute();
        $matiere = $stmt2->fetchAll(PDO::FETCH_ASSOC);


        ?>

        <label for="metiere">La matière:</label><br>
<select name="matiere" id="matiere">
<?php foreach ($matiere as $mat){?>
<option value="<?= $mat['id_matiere']   ?>"><?= $mat['nom_matiere']   ?></option>

<?php };?>
</select>
<br><br>

<label for="groupe">Le groupe:</label><br>
<select name="groupe" id="groupe">
    <option value="A">TP A</option>
    <option value="B">TP B</option>
    <option value="C">TP C</option>
    <option value="D">TP D</option>
    <option value="AB">TD AB</option>
    <option value="DC">TP DC</option>
    <option value="M">CM</option>
</select>

<br><br>
            
                <input id="sub" type="submit" value="Envoyer">
            </form>
        </div>






    </main>


</body>

</html>