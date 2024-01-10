<?php
include('connexion.php');
session_start();
?>

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
    <title>Les notes</title>

    <style>
    table {
        width: 90%;
        
        background-color: white;
        margin: auto;
        padding: 70px 100px ;
        margin-block: 50px;
        border-radius: 15px;
       
    }

    @media (max-width: 850px) {
        table {
            padding: 50px 20px ;
            width: 100%;
        }

        th {
        font-size: 1.4rem !important;
       
    }

    td {
        font-size: 0.9rem !important;
       
    }


    }

    th {
        font-size: 2rem;
       
    }
    tr {
        height: 2.5rem;
    }

    thead {
       height: 4.3rem;
    }

    .table-wrapper {
        width: 100%;
        background-color: transparent;
  
        min-height: 90%;
    }
    td:not(.titles) {
        text-align: center;
    }

    
    td {
        height: 1.8rem;
        font-size: 1.3rem;
    }

    main {
        background-color: var(--grey);
    }

    tbody tr:nth-child(odd) {
    background-color: var(--yellow1);
}
    
    </style>
         
    
</head>

<body>

    <main>
    

        <?php


         include('nav.php');
    
  
         
         $requete_exam = " 
             SELECT
                 eval_exam.id_eval_exam AS eval_id,
                 eval_exam.title_exam AS eval_title,
                 note_exam.note_exam AS eval_note,
                 eval_exam.coefficient,
                 cours.ext_matiere AS matiere,
                 note_exam.ext_etudiant,
                 note_exam.note_exam AS note,
                 nom_matiere, coef_matiere
                
             FROM
                 eval_exam
             LEFT JOIN
                 note_exam ON eval_exam.id_eval_exam = note_exam.ext_eval_exam
             LEFT JOIN 
                cours ON ext_cours = id_cours
             LEFT JOIN
                 matiere ON cours.ext_matiere = matiere.id_matiere
             WHERE
                 note_exam.ext_etudiant = :id_user;
         ";
         
         $stmt_exam = $db->prepare($requete_exam);
         $stmt_exam->bindValue(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
         $stmt_exam->execute();
         $exam_notes = $stmt_exam->fetchAll(PDO::FETCH_ASSOC);
        //  var_dump($exam_notes);
         
         $requete_project = "
             SELECT
                 eval_projet.id_eval_projet AS eval_id,
                 eval_projet.title_projet AS eval_title,
                 note_projet.note_projet AS eval_note,
                 eval_projet.coefficient,
                 eval_projet.ext_matiere AS matiere,
                 note_projet.ext_etudiant,
                 note_projet.note_projet AS note,
                 nom_matiere,
                 coef_matiere
             FROM
                 eval_projet
             LEFT JOIN
                 note_projet ON eval_projet.id_eval_projet = note_projet.ext_projet
             LEFT JOIN
                 matiere ON eval_projet.ext_matiere = matiere.id_matiere
             WHERE
                 note_projet.ext_etudiant = :id_user;
         ";
         
         $stmt_project = $db->prepare($requete_project);
         $stmt_project->bindValue(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
         $stmt_project->execute();
         $project_notes = $stmt_project->fetchAll(PDO::FETCH_ASSOC);
         
         // Merge Exam and Project Notes
         $merged_notes = array_merge($exam_notes, $project_notes);
         
       

        //  var_dump($merged_notes);



// Initialize an array to store the calculated data
$matiere_table = [];

foreach ($merged_notes as $note) {
    $matiere_id = $note['matiere'];

    // Check if the matiere_id already exists in the matiere_table array
    if (!isset($matiere_table[$matiere_id])) {
        // If not, initialize an array for that matiere_id
        $matiere_table[$matiere_id] = [
            'nom_matiere' => $note['nom_matiere'],
            'total_coefficient' => 0,
            'weighted_sum' => 0,
            'coef'  => $note['coef_matiere'],
        ];
    }

    // Update the total_coefficient and weighted_sum for the current matiere_id
    $matiere_table[$matiere_id]['total_coefficient'] += $note['coefficient'];
    $matiere_table[$matiere_id]['weighted_sum'] += $note['note'] * $note['coefficient'];
}

// Calculate the final note for each matiere
foreach ($matiere_table as &$matiere_data) {
    if ($matiere_data['total_coefficient'] > 0) {
        $matiere_data['final_note'] = round($matiere_data['weighted_sum'] / $matiere_data['total_coefficient'], 2);
    } else {
        $matiere_data['final_note'] = 'N/A'; // or any default value when total_coefficient is zero
    }
}

// Now $matiere_table contains the calculated data
// var_dump($matiere_table);

$requete_mmi1 = "SELECT nom_matiere, coef_matiere FROM matiere WHERE programme = '{$_SESSION['programme_user']}'";
$stmt_mmi1 = $db->query($requete_mmi1);
$mmi1_matieres = $stmt_mmi1->fetchAll(PDO::FETCH_ASSOC);

// Check and add missing matieres
foreach ($mmi1_matieres as $mmi1_matiere) {
    // Check if the matiere is not in $matiere_table
    if (!in_array($mmi1_matiere['nom_matiere'], array_column($matiere_table, 'nom_matiere'))) {
        // Add a new row to $matiere_table
        $matiere_table[] = array(
            'nom_matiere' => $mmi1_matiere['nom_matiere'],
            'coef' => $mmi1_matiere['coef_matiere'],
            'total_coefficient' => "-",
            'weighted_sum' => "-",
            'final_note' => "-",
        );
    }
}
?>


        

         <div class="table-wrapper">
             <table >
                     <thead>
                <tr>
                    <th>Matière</th>
                    <th> Coefficient</th>
                    <th>Note finale</th>
                </tr>
                     </thead>
                     <tbody>
                    <?php foreach ($matiere_table as $row) { ?>
                    <tr>
                        <td class="titles"><?= $row['nom_matiere'] ?></td>
                        <td><?= $row['coef'] ?></td>
                        <td><?= $row['final_note'] ?></td>
                    </tr>
                <?php  }; ?>
                     </tbody>
                 </table>
         </div>


















    </main>


</body>

</html>