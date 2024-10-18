<?php
require('../utils/fonctions_usuelles.php');
require('../utils/fonctions_villes.php');

// Récupérer la ville avec un ID valide
$ville = getVillesById(filter_input(INPUT_POST, 'ville_id', FILTER_VALIDATE_INT));

if (!$ville) {
    die('Ville non trouvée.');
}

// Validation des données POST
$villeNom = filter_input(INPUT_POST, 'ville_nom', FILTER_SANITIZE_STRING);
$villeDepartement = filter_input(INPUT_POST, 'ville_departement', FILTER_SANITIZE_STRING);
$villeRegion = filter_input(INPUT_POST, 'ville_region', FILTER_SANITIZE_STRING);

if (!$villeNom || !$villeDepartement || !$villeRegion) {
    die('Données invalides.');
}

// Mise à jour des informations de la ville
$ville['vil_nom'] = $villeNom;
$ville['vil_departement'] = $villeDepartement;
$ville['vil_region'] = $villeRegion;

if (updateVilles($ville)) {
    header('Location: ../../public/affichageVilles.php');
    exit;
} else {
    die('Erreur lors de la mise à jour de la ville.');
}
?>
