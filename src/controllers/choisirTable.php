<?php
session_start();

if(isset($_POST['choixTable'])) {
    $page = $_POST['choixTable'];
    switch ($page) {
        case 'donneesclimatiques':
            header('Location: ../../public/affichageDonneesClimatiques.php');
            break;
        case 'stationmeteo':
            header('Location: ../../public/affichageStationMeteo.php');
            break;
        case 'villes':
            header('Location: ../../public/affichageVilles.php');
            break;
    }
}
?>
