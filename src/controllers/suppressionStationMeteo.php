<?php
session_start();
require('../utils/fonctions_usuelles.php');
require('../utils/fonctions_stationmeteo.php');

$idSession = &$_SESSION['idStation'];
$id = intval($idSession,10);

deleteStationMeteo($id);

header('Location: ../../public/affichageStationMeteo.php');
?>