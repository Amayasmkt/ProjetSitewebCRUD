<?php
    require(__DIR__ . '/../../config/cnx.php');

    // fonctions pour la table g06_stationmeteo
    function getStattionMeteoById(int $id) : array
    {
        $ptrDB = connexion();

        $query = 'SELECT * FROM g06_stationmeteo WHERE station_id = $1';
        pg_prepare($ptrDB, 'reqSelectSMById', $query);
        $ptrQuery = pg_execute($ptrDB, 'reqSelectSMById', array($id));


        if (isset($ptrQuery)){
            $resu = pg_fetch_assoc($ptrQuery);
            if(empty($resu)){
                $resu = array("message"=>"Identifiant de station météo non valide", $id);
            }
        }
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
        return $resu;
    }

    function getAllStationMeteo() : array {
        $ptrDB = connexion();

        //Préparation de la requête
        $query = "SELECT * FROM g06_stationmeteo";
        pg_prepare($ptrDB, "reqPrepSelectAll", $query);

        //execution de la requête
        $ptrQuery = pg_execute($ptrDB, "reqPrepSelectAll", array());

        $resu = array();

        if (isset($ptrQuery)) {
            while($ligne = pg_fetch_array($ptrQuery)) {
                array_push($resu, array("station_id"=>$ligne[0],"station_nom"=>$ligne[1],"station_altitude"=>$ligne[2],
                    "vil_id"=>$ligne[3]));
            }
        }

        //libération de la mémoire
        pg_free_result($ptrQuery);
        pg_close($ptrDB);

        return $resu;
    }

    function insertStationMeteo(array $stationMeteo) : array {
        $ptrDB = connexion();

        //Préparation de la requête
        $query = "INSERT INTO g06_stationmeteo(station_id,station_nom,station_altitude,vil_id)
                            VALUES ($1,$2,$3,$4)";

        pg_prepare($ptrDB,"reqInsertNewSM",$query);

        //execution de la requête
        $ptrQuery = pg_execute($ptrDB,"reqInsertNewSM",array($stationMeteo['station_id'],$stationMeteo['station_nom'],
            $stationMeteo['station_altitude'],$stationMeteo['vil_id']));

        //libération de la mémoire
        pg_free_result($ptrQuery);
        pg_close($ptrDB);

        return getStattionMeteoById($stationMeteo['station_id']);
    }

    function updateStationMeteo(array $stationMeteo): array  {
        $ptrDB = connexion();
        $smCode = $stationMeteo['station_id'];

        //préparation de la requête
        $query = "UPDATE g06_stationmeteo SET station_nom=$1,station_altitude=$2,vil_id=$3 WHERE station_id=$smCode";
        pg_prepare($ptrDB,"reqUpdateSM",$query);
        //execution de la requête
        $ptrQuery = pg_execute($ptrDB,"reqUpdateSM",array($stationMeteo['station_nom'],$stationMeteo['station_altitude'],
            $stationMeteo['vil_id']));
        //libération de la mémoire
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
        return getStattionMeteoById($stationMeteo['station_id']);
    }

    function deleteStationMeteo(int $id): void  {
        $ptrDB = connexion();

        //préparation de la requête
        $query = "DELETE FROM g06_stationmeteo WHERE station_id=$1";
        pg_prepare($ptrDB,"reqDelSM",$query);
        //execution de la requête
        $ptrQuery = pg_execute($ptrDB,"reqDelSM",array($id));
        //libération de ma mémoire
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
    }
?>