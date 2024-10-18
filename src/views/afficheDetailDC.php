<?php
    session_start();
    require('../utils/fonctions_usuelles.php');
    require('../utils/fonctions_donneesclimatiques.php');

    $idSession = &$_SESSION['idDC'];
    $idDC = intval($idSession,10);
    $donneClim = getDonneeClimById($idDC);

    $id = $donneClim['dc_id'];
    $tempMax = $donneClim['dc_tempmax'];
    $tempMin = $donneClim['dc_tempmin'];
    $precipitaion = $donneClim['dc_precipitation'];
    $ensoleillement = $donneClim['dc_ensoleillement'];
    $rafale = $donneClim['dc_rafales'];
    $date = $donneClim['dc_date'];
    $station = $donneClim['station_id'];

    // Affichage des detailes en HTML
    $affichage = "<h1>Détail de $id</h1>";
    $affichage .= "<ul>";
    $affichage .= "<li> <b>identifiant  : </b> $id</li>";
    $affichage .= "<li> <b> Temperature Maximum: </b> $tempMax</li>";
    $affichage .= "<li> <b> Temperature Minimum : </b> $tempMin</li>";
    $affichage .= "<li> <b> Precipitation : </b> $precipitaion</li>";
    $affichage .= "<li> <b> Ensoleillement : </b> $ensoleillement</li>";
    $affichage .= "<li> <b> Rafales : </b> $rafale</li>";
    $affichage .= "<li> <b> Date : </b> $date</li>";
    $affichage .= "<li> <b> Station : </b> $station</li>";
    $affichage .= "</ul> <br />";
    $affichage .= "<a href='../../public/affichageDonneesClimatiques.php'>Retour</a>"."<br />";

    echo $affichage;
?>