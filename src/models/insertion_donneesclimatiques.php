<?php
    require('../utils/fonctions_usuelles.php');
    //require('fonctions_donneesclimatiques.php');
    require('../utils/fonctions_stationmeteo.php');

    $pageHTML = getDebutHtml("Insertion de données climatiques");

    $tableauFormulaire = "<table border='0'><tr>";

    $tableauFormulaire .= "<th>Température maximale: </th>";
    $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"tempMax","required"=>""))
                            ."</td>"."</tr>";

    $tableauFormulaire .= "<tr>"."<th>Température minimale: </th>";
    $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"tempMin","required"=>""))
                            ."</td>"."</tr>";
    
    $tableauFormulaire .= "<tr>"."<th>Précipitation: </th>";
    $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"precipitation","required"=>""))
                            ."</td>"."</tr>";
    
    $tableauFormulaire .= "<tr>"."<th>Ensoleillement : </th>";
    $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"ensoleillement","pattern"=>"[0-9]{2}:[0-5][0-9]:[0-5][0-9]",
    "placeholder"=>"heure:minute:seconde","required"=>""))."</td>"."</tr>";
    
    $tableauFormulaire .= "<tr>"."<th>Rafales: </th>";
    $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"rafales","required"=>""))
    ."</td>"."</tr>";
    
    $tableauFormulaire .= "<tr>"."<th>Date: </th>";
    $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"date","name"=>"date","required"=>""))
    ."</td>"."</tr>";

    // Récupération des id et noms des station:
    $allStations = getAllStationMeteo();

    $stationIdNom = array();
    for($i = 0; $i < count($allStations); $i++) {
        $id = $allStations[$i]['station_id'];
        $nom = $allStations[$i]['station_nom'];
        $station = $id." - ".$nom;
        array_push($stationIdNom,$station);
    }

    $optionStation = null;
    for($i=0; $i < count($stationIdNom); $i++) {
        $optionStation .= intoBalise("option",$stationIdNom[$i],array("value"=>$i+1));
    }

    $tableauFormulaire .= "<tr>"."<th>Station : </th>";
    $tableauFormulaire .= intoBalise("td",intoBalise("select",$optionStation,array("name"=>"stationMeteoChoix","required"=>"")))."</tr>";
    
    $tableauFormulaire .= "<tr>".intoBalise("td",intoBalise("button","Envoyer",array("type"=>"submit")));
    $tableauFormulaire .= intoBalise("td",intoBalise("button","Effacer",array("type"=>"reset")))."</tr>";

    $tableauFormulaire .= "</table>";
    
    $body = $tableauFormulaire;

    $formulaire = intoBalise("form",$body,array("action"=>"../controllers/inserer_donneesclimatiques.php","method"=>"post"));
    
    $pageHTML .= $formulaire;

    $pageHTML .= getFinHtml();
    echo $pageHTML;
?>