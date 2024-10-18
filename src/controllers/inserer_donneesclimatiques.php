<?php
    require('../utils/fonctions_donneesclimatiques.php');

    $donneClim['dc_id'] = count(getAllDonneeClim())+1;
    $donneClim['dc_tempmax'] = floatval($_POST['tempMax']);
    $donneClim['dc_tempmin'] = floatval($_POST['tempMin']);
    $donneClim['dc_precipitation'] = floatval($_POST['precipitation']);
    $donneClim['dc_ensoleillement'] = $_POST['ensoleillement'];
    $donneClim['dc_rafales'] = floatval($_POST['rafales']);
    $donneClim['dc_date'] = $_POST['date'];
    $donneClim['station_id'] = $_POST['stationMeteoChoix'];

    insertDonneeClim($donneClim);
    header('Location: ../../public/affichageDonneesClimatiques.php');
?>