<?php
session_start();
require('../utils/fonctions_usuelles.php');
require('../utils/fonctions_villes.php');

$idSession = &$_SESSION['idVille'];
$id = intval($idSession,10);


deleteVilles($id);

header('Location: ../../public/affichageVilles.php');
?>