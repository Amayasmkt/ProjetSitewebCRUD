<?php
session_start();
require('../utils/fonctions_usuelles.php');
require('../utils/fonctions_villes.php');

$idSession = &$_SESSION['idVille'];
$idVille = intval($idSession,10);
$ville = getVillesById($idVille);

$id = $ville['vil_id'];
$nom = $ville['vil_nom'];
$departement = $ville['vil_departement'];
$region = $ville['vil_region'];

$pageHTML = getDebutHtml("Insertion de villes");

$tableauFormulaire = "<table border='0'><tr>";

$tableauFormulaire .= "<th>ID de la ville (non-modifiable): </th>";
$tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"ville_id","value"=>$id,"readonly"=>""))
                        ."</td>"."</tr>";

$tableauFormulaire .= "<th>Nom de la ville: </th>";
$tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"ville_nom","value"=>$nom,"required"=>""))
                        ."</td>"."</tr>";

$tableauFormulaire .= "<tr>"."<th>Département de la ville: </th>";
$tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"ville_departement","value"=>$departement,"required"=>""))
                        ."</td>"."</tr>";

$tableauFormulaire .= "<tr>"."<th>Région de la ville: </th>";
$tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"ville_region","value"=>$region,"required"=>""))
                        ."</td>"."</tr>"; 

$tableauFormulaire .= "<tr>".intoBalise("td",intoBalise("button","Envoyer",array("type"=>"submit")));
$tableauFormulaire .= intoBalise("td",intoBalise("button","Effacer",array("type"=>"reset")))."</tr>";
                    
$tableauFormulaire .= "</table>";
                        
$body = $tableauFormulaire;
                    
$formulaire = intoBalise("form",$body,array("action"=>"../models/gestionModifVille.php","method"=>"post"));
                        
$pageHTML .= $formulaire;

$pageHTML .= getFinHtml();
echo $pageHTML;
?>