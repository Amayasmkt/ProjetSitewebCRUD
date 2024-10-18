<?php
session_start();
require('../utils/fonctions_usuelles.php');
require('../utils/fonctions_stationmeteo.php');

$idSession = &$_SESSION['idStation'];
$idStation = intval($idSession,10);
$station = getStattionMeteoById($idSession);

$id = $station['station_id'];
$nom = $station['station_nom'];
$altitude = $station['station_altitude'];
$ville = $station['vil_id'];

$affichage = "<h1>Détail de $nom</h1>";
$affichage .= "<ul>";
$affichage .= "<li> <b>Id Station : </b> $id</li>";
$affichage .= "<li> <b> Nom Station : </b> $nom</li>";
$affichage .= "<li> <b> Altitude : </b> $altitude</li>";
$affichage .= "<li> <b> Ville : </b> $ville</li>";
$affichage .= "</ul> <br />";
$affichage .= "<a href='../../public/affichageStationMeteo.php'>Retour</a>"."<br />";

echo $affichage;
?>
