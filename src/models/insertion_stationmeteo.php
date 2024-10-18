<?php
    require('../utils/fonctions_usuelles.php');
    require('../utils/fonctions_villes.php');

    $pageHTML = getDebutHtml("Insertion de station météorologique");

    $tableauFormulaire = "<table border='0'><tr>";

    $tableauFormulaire .= "<th>Nom de la station: </th>";
    $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"nom_station","required"=>""))
                            ."</td>"."</tr>";

    $tableauFormulaire .= "<tr>"."<th>Altitude de la satiation: </th>";
    $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"alt_station","required"=>""))
                            ."</td>"."</tr>"; 
    
    // Récupération des id et noms de ville

    $allVilles = getAllVilles();

    $villeIdNom = array();
    for($i = 0; $i < count($allVilles); $i++) {
        $id = $allVilles[$i]['vil_id'];
        $nom = $allVilles[$i]['vil_nom'];
        $ville = $id." - ".$nom;
        array_push($villeIdNom,$ville);
    }

    $optionVille = null;
    for($i=0; $i < count($villeIdNom); $i++) {
        $optionVille .= intoBalise("option",$villeIdNom[$i],array("value"=>$i+1));
    }

    $tableauFormulaire .= "<tr>"."<th>Ville : </th>";
    $tableauFormulaire .= intoBalise("td",intoBalise("select",$optionVille,array("name"=>"villeChoix","required"=>"")))."</tr>";
    
    $tableauFormulaire .= "<tr>".intoBalise("td",intoBalise("button","Envoyer",array("type"=>"submit")));
    $tableauFormulaire .= intoBalise("td",intoBalise("button","Effacer",array("type"=>"reset")))."</tr>";
                        
    $tableauFormulaire .= "</table>";
                            
    $body = $tableauFormulaire;
                        
    $formulaire = intoBalise("form",$body,array("action"=>"../controllers/inserer_stationmeteo.php","method"=>"post"));
                            
    $pageHTML .= $formulaire;

    $pageHTML .= getFinHtml();
    echo $pageHTML;
?>