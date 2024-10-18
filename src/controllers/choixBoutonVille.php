<?php
session_start();
require('../utils/fonctions_usuelles.php');

if(isset($_POST['boutonConsulter']) && $_POST['boutonConsulter'] == 'Consulter') {
    $_SESSION['idVille'] = $_POST['idVille'];
    header('Location: ../views/afficheDetailVilles.php');
}
elseif(isset($_POST['boutonModifier']) && $_POST['boutonModifier'] == 'Modifier') {
    $_SESSION['idVille'] = $_POST['idVille'];
    header('Location: ./modificationVille.php');
}
elseif(isset($_POST['boutonSupprimer']) && $_POST['boutonSupprimer'] == 'Supprimer') {
    $_SESSION['idVille'] = $_POST['idVille'];
    header('Location: ./suppressionVille.php');
}
?>