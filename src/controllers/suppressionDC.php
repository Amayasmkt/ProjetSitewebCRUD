<?php
session_start();
require('../utils/fonctions_usuelles.php');
require('../utils/fonctions_donneesclimatiques.php');

$idSession = &$_SESSION['idDC'];
$id = intval($idSession,10);

deleteDonneeClim($id);

header('Location: ../../public/affichageDonneesClimatiques.php');
?>