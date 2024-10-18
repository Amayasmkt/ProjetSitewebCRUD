<?php
    require('../utils/fonctions_stationmeteo.php');

    $stationmeteo['station_id'] = count(getAllStationMeteo())+1;
    $stationmeteo['station_nom'] = $_POST['nom_station'];
    $stationmeteo['station_altitude'] = intval($_POST['alt_station'],10);
    $stationmeteo['vil_id'] = $_POST['villeChoix'];

    insertStationMeteo($stationmeteo);
    header('Location: ../../public/affichageStationMeteo.php');
?>