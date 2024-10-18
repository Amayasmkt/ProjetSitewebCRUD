<?php
session_start();
require('../utils/fonctions_usuelles.php');

if(isset($_POST['boutonConsulter']) && $_POST['boutonConsulter'] == 'Consulter') {
    $_SESSION['idStation'] = $_POST['idStationMeteo'];
    header('Location: ../views/afficheDetailStationMeteo.php');
}
elseif(isset($_POST['boutonModifier']) && $_POST['boutonModifier'] == 'Modifier') {
    $_SESSION['idStation'] = $_POST['idStationMeteo'];
    header('Location: ./modificationStationMeteo.php');
}
elseif(isset($_POST['boutonSupprimer']) && $_POST['boutonSupprimer'] == 'Supprimer') {
    $_SESSION['idStation'] = $_POST['idStationMeteo'];
    header('Location: ./suppressionStationMeteo.php');
}
?>