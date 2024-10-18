<?php
    require('../src/utils/fonctions_villes.php');
    require('../src/utils/fonctions_usuelles.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenu de villes</title>
</head>
<body>
    
<?php
    echo "<h1>Contenu de villes :</h1>";

    echo "<a href='./Accueil.php'>Retour</a>"."<br />";

    echo "<a href='../src/models/insertion_villes.php'>Insérer une nouvelle ville </a>"."<br />";

    $allVilles = getAllVilles();

    $tableau = "<table border='0'>
    <tr>
    <th>vil_id</th> <th>vil_nom</th>
    </tr>";

    $ligne = null;
    
    for($i=0; $i < count($allVilles); $i++) {
        $ligne .= "<tr>";
        $ligne .= "<td>".$allVilles[$i]['vil_id']."</td>";
        $ligne .= "<td>".$allVilles[$i]['vil_nom']."</td>";
        // Afficher d'autres détails de la ville (département, région, etc.) si nécessaire
        
        // Boutons de formulaire
        $ligne .= "<td>";
        $ligne .= "<form action='../src/controllers/choixBoutonVille.php' method='post'>";
        $ligne .= "<input type='hidden' name='idVille' value='".$allVilles[$i]['vil_id']."'>";
        $ligne .= "<input type='submit' name='boutonConsulter' value='Consulter'>";
        $ligne .= "<input type='submit' name='boutonModifier' value='Modifier'>";
        $ligne .= "<input type='submit' name='boutonSupprimer' value='Supprimer'>";
        $ligne .= "</form>";
        $ligne .= "</td>";
        $ligne .= "</tr>";
    }
    

    $tableau .= $ligne;
    $tableau .= "</table>";

    echo $tableau;
?>

</body>
</html>