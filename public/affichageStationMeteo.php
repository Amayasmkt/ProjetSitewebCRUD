<?php
    require('../src/utils/fonctions_stationmeteo.php');
    require('../src/utils/fonctions_usuelles.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des stations météos</title>
</head>
<body>
    
<?php
    echo "<h1>Conetnu des stations météorologiques :</h1>";
    echo "<a href='./Accueil.php'>Retour</a>"."<br />";
    echo "<a href='../src/models/insertion_stationmeteo.php'>Insérer une nouvelle station  </a>"."<br />";

    $allStationMeteo = getAllStationMeteo();

    $tableau = "<table border=0>
    <tr>
    <th>station_id</th> <th>station_nom</th>
    </tr>";

    $ligne = null;
    for ($i = 0; $i < count($allStationMeteo); $i++) {
        $ligne .= "<tr>";
        $ligne .= "<td>" . $allStationMeteo[$i]['station_id'] . "</td>";
        $ligne .= "<td>" . $allStationMeteo[$i]['station_nom'] . "</td>";
        
        // Boutons de formulaire
        $ligne .= "<td>";
        $ligne .= "<form action='../src/controllers/choixBoutonStation.php' method='post'>";
        $ligne .= "<input type='hidden' name='idStationMeteo' value='" . $allStationMeteo[$i]['station_id'] . "'>";
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