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
        <link rel="stylesheet" href="detail_actualite.css"> 
    <title>Articles</title>

    
</head>

<body>

    <main>
        <?php
        session_start();
        include('nav.php');
        include('connexion.php');
        //Récupère l'id de l'article pour afficher les bonnes informations
        $id_actu = $_GET['id'];
        $stmt=$db->query("SELECT * FROM actualite WHERE id_actu = $id_actu");
        $result=$stmt->fetch(PDO::FETCH_ASSOC); 
        
        $date = $result['actu_date'];
        ?>
            
        <div class="article">
        <p class="date"><?= $date ?></p>
            <div class="titre_img">
                <?php
                if(isset($id_actu)){
                ?>
                <h1><?= $result['actu_titre']?></h1>
                
                <img src="./img/actualites/<?= $result['actu_img']?>" alt="">
            </div>
            
            <p class="text_actu"><?= $result['actu_text']?></p>

            <?php } else { ?>
            <p>Cet article n'est pas disponible</p>
            <?php }?>
        </div>

    </main>


</body>

</html>