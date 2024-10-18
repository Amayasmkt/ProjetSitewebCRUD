<?php
session_start();
require('../utils/fonctions_usuelles.php');

if(isset($_POST['boutonConsulter']) && $_POST['boutonConsulter'] == 'Consulter') {
    $_SESSION['idDC'] = $_POST['idDonneeClim'];
    header('Location: ../views/afficheDetailDC.php');
}
elseif(isset($_POST['boutonModifier']) && $_POST['boutonModifier'] == 'Modifier') {
    $_SESSION['idDC'] = $_POST['idDonneeClim'];
    header('Location: ./modificationDC.php');
}
elseif(isset($_POST['boutonSupprimer']) && $_POST['boutonSupprimer'] == 'Supprimer') {
    $_SESSION['idDC'] = $_POST['idDonneeClim'];
    header('Location: ./suppressionDC.php');
}
?>
