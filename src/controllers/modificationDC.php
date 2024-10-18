<?php
session_start();
require('../utils/fonctions_usuelles.php');
require('../utils/fonctions_donneesclimatiques.php');

// Fonction pour récupérer toutes les stations météo
function getAllStationMeteo() : array {
    $ptrDB = connexion();

    // Préparation de la requête
    $query = "SELECT * FROM g06_stationmeteo";
    pg_prepare($ptrDB, "reqPrepSelectAll", $query);

    // Exécution de la requête
    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectAll", array());

    $resu = array();

    if ($ptrQuery) {
        while($ligne = pg_fetch_array($ptrQuery)) {
            array_push($resu, array(
                "station_id" => $ligne['station_id'],
                "station_nom" => $ligne['station_nom'],
                "station_altitude" => $ligne['station_altitude'],
                "vil_id" => $ligne['vil_id']
            ));
        }
    }

    // Libération de la mémoire
    pg_free_result($ptrQuery);
    pg_close($ptrDB);

    return $resu;
}

// Récupération de l'ID de la session
$idSession = $_SESSION['idDC'] ?? null;

if ($idSession) {
    $idDC = intval($idSession, 10);
    $donneClim = getDonneeClimById($idDC);

    if ($donneClim) {
        $id = $donneClim['dc_id'];
        $tempMax = $donneClim['dc_tempmax'];
        $tempMin = $donneClim['dc_tempmin'];
        $precipitation = $donneClim['dc_precipitation']; // Correction du nom de la variable
        $ensoleillement = $donneClim['dc_ensoleillement'];
        $rafale = $donneClim['dc_rafales'];
        $date = $donneClim['dc_date'];
        $station = $donneClim['station_id'];

        // Génération du formulaire HTML
        $pageHTML = getDebutHtml("Modification de données climatiques");

        $tableauFormulaire = "<table border='0'><tr>";
        $tableauFormulaire .= "<th>ID de la donnée (non-modifiable): </th>";
        $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"id","value"=>$id,"readonly"=>""))."</td></tr>";

        $tableauFormulaire .= "<tr><th>Température maximale: </th>";
        $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"tempMax","value"=>$tempMax,"required"=>""))."</td></tr>";

        $tableauFormulaire .= "<tr><th>Température minimale: </th>";
        $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"tempMin","value"=>$tempMin,"required"=>""))."</td></tr>";
    
        $tableauFormulaire .= "<tr><th>Précipitation: </th>";
        $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"precipitation","value"=>$precipitation,"required"=>""))."</td></tr>";
    
        $tableauFormulaire .= "<tr><th>Ensoleillement : </th>";
        $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"ensoleillement","pattern"=>"[0-9]{2}:[0-5][0-9]:[0-5][0-9]","placeholder"=>"heure:minute:seconde","value"=>$ensoleillement,"required"=>""))."</td></tr>";
    
        $tableauFormulaire .= "<tr><th>Rafales: </th>";
        $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"rafales","value"=>$rafale,"required"=>""))."</td></tr>";
    
        $tableauFormulaire .= "<tr><th>Date: </th>";
        $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"date","name"=>"date","value"=>$date,"required"=>""))."</td></tr>";

        // Récupération des stations météo
        $allStations = getAllStationMeteo();

        $optionStation = null;
        foreach ($allStations as $station) {
            $stationId = $station['station_id'];
            $stationNom = $station['station_nom'];
            $selected = ($stationId == $donneClim['station_id']) ? "selected" : ""; // Sélectionne la station actuelle
            $optionStation .= intoBalise("option", "$stationId - $stationNom", array("value" => $stationId, $selected => $selected));
        }

        $tableauFormulaire .= "<tr><th>Station : </th>";
        $tableauFormulaire .= intoBalise("td", intoBalise("select", $optionStation, array("name"=>"stationMeteoChoix", "required"=>"")))."</tr>";
    
        $tableauFormulaire .= "<tr>".intoBalise("td",intoBalise("button","Envoyer",array("type"=>"submit")));
        $tableauFormulaire .= intoBalise("td",intoBalise("button","Effacer",array("type"=>"reset")))."</tr>";

        $tableauFormulaire .= "</table>";

        // Génération du formulaire
        $formulaire = intoBalise("form", $tableauFormulaire, array("action"=>"../models/gestionModifDC.php", "method"=>"post"));
    
        $pageHTML .= $formulaire;
        $pageHTML .= getFinHtml();
        
        echo $pageHTML;
    } else {
        echo "Données climatiques introuvables.";
    }
} else {
    echo "ID de la session manquant.";
}
?>
