<?php
    require(__DIR__ . '/../src/utils/fonctions_usuelles.php');
    require(__DIR__ . '/../src/utils/fonctions_donneesclimatiques.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenu de données climatiques</title>
</head>
<body>
    
<?php
    echo "<h1>Conetnu des données climatiques :</h1>";
    echo "<a href='./Accueil.php'>Retour</a>"."<br />";
    echo "<a href='../src/models/insertion_donneesclimatiques.php'>Insérer une donnée climatique  </a>"."<br />";

    $allDonnees = getAllDonneeClim();

    $tableau = "<table border=0>
    <tr>
    <th>dc_id</th> <th>dc_tempmax</th> <th>dc_tempmin</th> <th>dc_precipitaion</th>
    </tr>";

    $ligne = null;
    for ($i = 0; $i < count($allDonnees); $i++) {
        $ligne .= "<tr>";
        $ligne .= "<td>" . $allDonnees[$i]['dc_id'] . "</td>";
        $ligne .= "<td>" . $allDonnees[$i]['dc_tempMax'] . "</td>";
        $ligne .= "<td>" . $allDonnees[$i]['dc_tempMin'] . "</td>";
        
        // Boutons de formulaire
        $ligne .= "<td>";
        $ligne .= "<form action='../src/controllers/choixBoutonDC.php' method='post'>";
        $ligne .= "<input type='hidden' name='idDonneeClim' value='" . $allDonnees[$i]['dc_id'] . "'>";
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