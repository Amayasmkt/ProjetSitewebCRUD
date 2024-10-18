<?php
require('../utils/fonctions_usuelles.php');
require('../utils/fonctions_stationmeteo.php');

// Récupérer la station météo avec un ID valide
$station = getStattionMeteoById(1);

if (!$station) {
    die('Station météo non trouvée.');
}

// Validation des données POST
$stationId = filter_input(INPUT_POST, 'id_station', FILTER_VALIDATE_INT);
$stationNom = filter_input(INPUT_POST, 'nom_station', FILTER_SANITIZE_STRING);
$stationAltitude = filter_input(INPUT_POST, 'alt_station', FILTER_VALIDATE_FLOAT);
$villeChoix = filter_input(INPUT_POST, 'villeChoix', FILTER_VALIDATE_INT);

if (!$stationId || !$stationNom || !$stationAltitude || !$villeChoix) {
    die('Données invalides.');
}

// Mise à jour des informations de la station
$station['station_id'] = $stationId;
$station['station_nom'] = $stationNom;
$station['station_altitude'] = $stationAltitude;
$station['vil_id'] = $villeChoix;

if (updateStationMeteo($station)) {
    header('Location: ../../public/affichageStationMeteo.php');
    exit;
} else {
    die('Erreur lors de la mise à jour de la station météo.');
}
?>
