<?php
    require('../utils/fonctions_villes.php');

    $ville['vil_id'] = count(getAllVilles())+1;
    $ville['vil_nom'] = $_POST['ville_nom'];
    $ville['vil_departement'] = $_POST['ville_department'];
    $ville['vil_region'] = $_POST['ville_region'];

    insertVilles($ville);
    header('Location: ../../public/affichageVilles.php');
?>