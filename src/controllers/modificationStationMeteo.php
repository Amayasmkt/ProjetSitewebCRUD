<?php
session_start();
require('../utils/fonctions_usuelles.php');
require('../utils/fonctions_stationmeteo.php');
require('../../config/monEnv.php');

// Étant donné que la fonction connexion() est présente dans 'fonctions_stationmeteo.php' et 'fonctions_villes.php'
// On implémente la fonction getAllVilles() dans ce fichier, et on n'ajoute pas le fichier 'fonctions_villes.php'
function getAllVilles() : array {
    $ptrDB = connexion();

    //Préparation de la requête
    $query = "SELECT * FROM g06_villes";
    pg_prepare($ptrDB, "reqPrepSelectAll", $query);

    //execution de la requête
    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectAll", array());

    $resu = array();

    if (isset($ptrQuery)) {
        while($ligne = pg_fetch_array($ptrQuery)) {
            array_push($resu, array("vil_id"=>$ligne[0],"vil_nom"=>$ligne[1],"vil_departement"=>$ligne[2],
                "vil_region"=>$ligne[3]));
        }
    }

    //libération de la mémoire
    pg_free_result($ptrQuery);
    pg_close($ptrDB);

    return $resu;
}

$idSession = &$_SESSION['idStation'];
$idStation = intval($idSession,10);
$station = getStattionMeteoById($idSession);

$id = $station['station_id'];
$nom = $station['station_nom'];
$altitude = $station['station_altitude'];

$pageHTML = getDebutHtml("Insertion de station météorologique");

$tableauFormulaire = "<table border='0'><tr>";

$tableauFormulaire .= "<th>ID de la station (non-modifiable): </th>";
$tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"id_station","value"=>$id,"readonly"=>""))
                        ."</td>"."</tr>";

$tableauFormulaire .= "<th>Nom de la station: </th>";
$tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"nom_station","value"=>$nom,"required"=>""))
                        ."</td>"."</tr>";

$tableauFormulaire .= "<tr>"."<th>Altitude de la satiation: </th>";
$tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"alt_station","value"=>$altitude,"required"=>""))
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
                    
$formulaire = intoBalise("form",$body,array("action"=>"../models/gestionModifStationMeteo.php","method"=>"post"));
                        
$pageHTML .= $formulaire;

$pageHTML .= getFinHtml();
echo $pageHTML;
?>