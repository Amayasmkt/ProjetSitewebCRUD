<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    
<?php
    echo "<p>Sélctionnez la table que vous souhaitez consulter et/ou modifier: </p>";
    echo "<form action='../src/controllers/choisirTable.php' method='post'>
    <select name='choixTable'>
    <option value='donneesclimatiques'>Donées climatiques</option>
    <option value='stationmeteo'>Station météorologique</option>
    <option value='villes'>Villes</option>
    </select>
    <input type='submit' value='Valider' />
    </form>";
?>

</body>
</html>
