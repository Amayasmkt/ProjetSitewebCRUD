<?php
require('../utils/fonctions_usuelles.php');
require('../utils/fonctions_donneesclimatiques.php');

// Vérifier si la méthode de la requête est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Valider que toutes les données nécessaires sont présentes dans $_POST
    if (isset($_POST['id'], $_POST['tempMax'], $_POST['tempMin'], $_POST['precipitation'], 
              $_POST['ensoleillement'], $_POST['rafales'], $_POST['date'], $_POST['stationMeteoChoix'])) {
        
        // Récupérer l'ID de la donnée climatique depuis le formulaire
        $idDC = intval($_POST['id']);
        
        // Récupérer la donnée climatique depuis la base de données
        $dc = getDonneeClimById($idDC);

        if ($dc) {
            // Mettre à jour les valeurs de la donnée climatique avec les informations du formulaire
            $dc['dc_tempmax'] = $_POST['tempMax'];
            $dc['dc_tempmin'] = $_POST['tempMin'];
            $dc['dc_precipitation'] = $_POST['precipitation'];
            $dc['dc_ensoleillement'] = $_POST['ensoleillement'];
            $dc['dc_rafales'] = $_POST['rafales'];
            $dc['dc_date'] = $_POST['date'];
            $dc['station_id'] = $_POST['stationMeteoChoix']; // Utiliser l'ID de la station sélectionnée
            
            // Mise à jour de la donnée climatique
            updateDonneeClim($dc);
            
            // Redirection après la mise à jour
            header('Location: ../../public/affichageDonneesClimatiques.php');
            exit();
        } else {
            echo "Donnée climatique introuvable pour l'ID : " . $idDC;
        }
    } else {
        echo "Toutes les informations du formulaire ne sont pas disponibles.";
    }
} else {
    echo "Requête non valide.";
}
?>
