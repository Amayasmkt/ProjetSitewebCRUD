# Projet PHP - Gestion de Base de Données (CRUD)

Ce projet consiste en la création d'un site web permettant de gérer les tables d'une base de données à travers des opérations CRUD (Créer, Lire, Mettre à jour, Supprimer). Il a été réalisé dans le cadre d'un exercice pratique basé sur un site web similaire à celui vu en cours.

## Fonctionnalités

Le site permet de :
- **Consulter** et **éditer** l'ensemble des tables de la base de données.
- Insérer de nouveaux enregistrements dans une table.
- Modifier ou supprimer des enregistrements existants.

### Page d'accueil
La page d'accueil du site présente une liste des tables disponibles dans la base de données. Un formulaire permet de sélectionner une table à afficher.

Les fonctionnalités principales de la page d'accueil sont :
1. **Sélection de table** : Les utilisateurs peuvent choisir une table dans un formulaire. Le nom de la table choisie est mémorisé dans une variable de session.
2. **Redirection vers une page dédiée à la table choisie** :
   - Affiche un lien vers un formulaire d'insertion d'un nouvel enregistrement.
   - Affiche le contenu de la table sous forme de tableau.
   - Offre un lien pour retourner à la page d'accueil.

### Gestion des enregistrements

Pour chaque enregistrement de la table sélectionnée, trois actions sont disponibles via des boutons dans un formulaire :
1. **Consulter** :
   - Affiche une page détaillant les informations de l'enregistrement.
   - Précise si des informations associées existent dans d'autres tables (clés étrangères ou tables associatives).
2. **Modifier** :
   - Affiche un formulaire prérempli avec les données actuelles de l'enregistrement.
   - Les clés primaires ne sont pas modifiables.
   - Ce formulaire est similaire à celui d'insertion, mais avec les valeurs actuelles comme valeurs par défaut.
3. **Supprimer** :
   - Supprime l'enregistrement et redirige vers la page de consultation de la table.

### Gestion des clés étrangères

- Les clés étrangères ne sont pas directement affichées dans les tables.
- Lors de la consultation d'un enregistrement, les informations associées (via clés étrangères) sont récupérées et affichées dans des sections appropriées.

### Exemple d'implémentation - Table "Villes"

- **Consulter** : Affiche les détails d'une ville et les informations liées provenant d'autres tables.
- **Modifier** : Affiche un formulaire permettant de modifier les informations, avec les champs pré-remplis.
- **Supprimer** : Supprime la ville sélectionnée de la base de données.

## Installation et Utilisation

1. **Cloner le projet** :
```bash
   git clone https://github.com/Amayasmkt/ProjetSiteWebCRUD.git
   cd ProjetSiteWebCRUD
```

2. **Configurer la base de données** :
- Importez le fichier `.sql` dans votre base de données pour créer les tables nécessaires. (Les valeurs sont fournies à titre d'exmple).
- Modifiez le fichier de configuration de la connexion à la base de données `(/config/cnx.php ou équivalent)` avec vos propres identifiants.

3. **Démarrer le serveur** :
   ```bbash
    php -S localhost:8000
   ```
   
4. **Accéder au site** :
- Ouvrez un navigateur et rendez-vous à l'URL suivante : `http://localhost:8000`

## Structure du Projet
```bash
/project-root
│
├── /config               # Fichiers de configuration, comme la connexion à la base de données
│
├── /public               # Fichiers accessibles publiquement (index.php, accueil.php, etc.)
│
├── /src                  # Logique principale de l'application (modèles, contrôleurs)
│
├── /views                # Templates de présentation des données
│
├── /assets               # Fichiers CSS, JS, images
│
├── /sql                  # Fichier SQL pour la création des tables
│
└── README.md             # Ce fichier
```

## Technologies Utilisées
- PHP : Pour la gestion de la logique serveur et des interactions CRUD.
- SQL : Pour la gestion des bases de données.
- HTML/CSS : Pour la mise en forme et la structure des pages.

## Contributeurs
Amayas Mokhtari
