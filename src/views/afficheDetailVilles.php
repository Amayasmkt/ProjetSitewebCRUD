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

$affichage = "<h1>Détail de $nom</h1>";
$affichage .= "<ul>";
$affichage .= "<li> <b>Id Ville : </b> $id</li>";
$affichage .= "<li> <b> Nom Ville : </b> $nom</li>";
$affichage .= "<li> <b> Departement : </b> $departement</li>";
$affichage .= "<li> <b> Region : </b> $region</li>";
$affichage .= "</ul> <br />";
$affichage .= "<a href='../../public/affichageVilles.php'>Retour</a>"."<br />";

echo $affichage;
?>
