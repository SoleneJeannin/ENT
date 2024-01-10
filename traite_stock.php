<?php
session_start();

include('connexion.php');

if (isset($_POST['stock'])) {
    // Récupération des nouvelles données de stockage
    $nouveau_stock = $_POST['stock'];

        // Requête préparée SQL
        $stmt = $db->prepare("UPDATE materiel SET stock = :nouveau_stock WHERE id_materiel = :id_materiel");

        //Nouvelles données de stockage
        foreach ($nouveau_stock as $id_materiel => $stock_matos) {
            $stmt->bindParam(':id_materiel', $id_materiel, PDO::PARAM_INT);
            $stmt->bindParam(':nouveau_stock', $stock_matos, PDO::PARAM_INT);
            $stmt->execute();
        }


        header("Location:reservation_materiel.php?etat=misajour");
}
?>