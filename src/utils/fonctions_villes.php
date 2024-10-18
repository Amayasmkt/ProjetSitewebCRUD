<?php
    require(__DIR__ . '/../../config/cnx.php');

    // fonctions pour la table g06_villes
    function getVillesById(int $id) : array
    {
        $ptrDB = connexion();
        $query = 'SELECT * FROM g06_villes WHERE vil_id = $1';
        pg_prepare($ptrDB, 'reqSelectVilById', $query);
        $ptrQuery = pg_execute($ptrDB, 'reqSelectVilById', array($id));


        if (isset($ptrQuery)){
            $resu = pg_fetch_assoc($ptrQuery);
            if(empty($resu)){
                $resu = array("message"=>"Identifiant de villes non valide", $id);
            }
        }
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
        return $resu;
    }
    function getAllVilles() : array {
        $ptrDB = connexion();

        //Préparation de la requête
        $query = "SELECT * FROM g06_villes";
        pg_prepare($ptrDB, "reqPrepSelectAll", $query);

        //execution de la requête
        $ptrQuery = pg_execute($ptrDB, "reqPrepSelectAll", array());

        $resu = array();

        if (isset($ptrQuery)) {
            while($ligne = pg_fetch_array($ptrQuery)) {
                array_push($resu, array("vil_id"=>$ligne[0],"vil_nom"=>$ligne[1],"vil_departement"=>$ligne[2],
                    "vil_region"=>$ligne[3]));
            }
        }

        //libération de la mémoire
        pg_free_result($ptrQuery);
        pg_close($ptrDB);

        return $resu;
    }

    function insertVilles(array $villes) : array {
        $ptrDB = connexion();

        //Préparation de la requête
        $query = "INSERT INTO g06_villes(vil_id,vil_nom,vil_departement,vil_region)
                                VALUES ($1,$2,$3,$4)";

        pg_prepare($ptrDB,"reqInsertNewVille",$query);

        //execution de la requête
        $ptrQuery = pg_execute($ptrDB,"reqInsertNewVille",array($villes['vil_id'],$villes['vil_nom'],
            $villes['vil_departement'],$villes['vil_region']));

        //libération de la mémoire
        pg_free_result($ptrQuery);
        pg_close($ptrDB);

        return getVillesById($villes['vil_id']);
    }

    function updateVilles(array $villes): array  {
        $ptrDB = connexion();
        $villeCode = $villes['vil_id'];

        //préparation de la requête
        $query = "UPDATE g06_villes SET vil_nom=$1,vil_departement=$2,vil_region=$3 WHERE vil_id=$villeCode";
        pg_prepare($ptrDB,"reqUpdateVille",$query);
        //execution de la requête
        $ptrQuery = pg_execute($ptrDB,"reqUpdateVille",array($villes['vil_nom'],$villes['vil_departement'],
            $villes['vil_region']));
        //libération de la mémoire
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
        return getVillesById($villes['vil_id']);
    }

    function deleteVilles(int $id): void  {
        $ptrDB = connexion();

        //préparation de la requête
        $query = "DELETE FROM g06_villes WHERE vil_id=$1";
        pg_prepare($ptrDB,"reqDelVille",$query);
        //execution de la requête
        $ptrQuery = pg_execute($ptrDB,"reqDelVille",array($id));
        //libération de ma mémoire
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
    }
?>