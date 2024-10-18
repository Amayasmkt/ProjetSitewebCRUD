<?php
    require(__DIR__ . '/../../config/cnx.php');

    function getDonneeClimById(int $id) : array {
        $ptrDB = connexion();

        $query = "SELECT * FROM g06_donneesclimatiques WHERE dc_id = $1";

        pg_prepare($ptrDB, 'reqSelectDCById', $query);

        $ptrQuery = pg_execute($ptrDB, 'reqSelectDCById', array($id));

        if (isset($ptrQuery)) {
            $resu = pg_fetch_assoc($ptrQuery);
            if(empty($resu)) {
                $resu = array("message" => "Identifiant de Donnee Climatique non valide : $id");;
            }
        }

        pg_free_result($ptrQuery);
        pg_close($ptrDB);

        return $resu;
    }

    function getAllDonneeClim() : array {
        $ptrDB = connexion();
        
        //Préparation de la requête
        $query = "SELECT * FROM g06_donneesclimatiques";
        pg_prepare($ptrDB, "reqPrepSelectAll", $query);

        //execution de la requête
        $ptrQuery = pg_execute($ptrDB, "reqPrepSelectAll", array());
    
        $resu = array();
    
        if (isset($ptrQuery)) {
            while($ligne = pg_fetch_array($ptrQuery)) {
                array_push($resu, array("dc_id"=>$ligne[0],"dc_tempMax"=>$ligne[1],"dc_tempMin"=>$ligne[2],
                                        "dc_precipitation"=>$ligne[3],"dc_ensoleillement"=>$ligne[4],
                                        "dc_rafales"=>$ligne[5],"dc_date"=>$ligne[6],"station_id"=>$ligne[7]));
            }
        }

        //libération de la mémoire
        pg_free_result($ptrQuery);
        pg_close($ptrDB);

        return $resu;
    }

    function insertDonneeClim(array $donneeClim) : array {
        $ptrDB = connexion();
    
        //Préparation de la requête
        $query = "INSERT INTO g06_donneesclimatiques(dc_id,dc_tempmax,dc_tempmin,dc_precipitation,dc_ensoleillement,dc_rafales,dc_date,station_id)
                    VALUES ($1,$2,$3,$4,$5,$6,$7,$8)";
    
        pg_prepare($ptrDB,"reqInsertNewDC",$query);
        
        //execution de la requête
        $ptrQuery = pg_execute($ptrDB,"reqInsertNewDC",array($donneeClim['dc_id'],$donneeClim['dc_tempmax'],
        $donneeClim['dc_tempmin'],$donneeClim['dc_precipitation'],$donneeClim['dc_ensoleillement'],
        $donneeClim['dc_rafales'],$donneeClim['dc_date'],$donneeClim['station_id']));
    
        //libération de la mémoire
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
    
        return getDonneeClimById($donneeClim['dc_id']);
    }

    function updateDonneeClim(array $donneeClim): array  {
        $ptrDB = connexion();
        $dcCode = $donneeClim['dc_id'];
    
        //préparation de la requête
        $query = "UPDATE g06_donneesclimatiques SET dc_tempmax=$1,dc_tempmin=$2,dc_precipitation=$3,dc_ensoleillement=$4,dc_rafales=$5,dc_date=$6 
        WHERE dc_id='$dcCode'";
        pg_prepare($ptrDB,"reqUpdateDC",$query);
        //execution de la requête
        $ptrQuery = pg_execute($ptrDB,"reqUpdateDC",array($donneeClim['dc_tempmax'],$donneeClim['dc_tempmin'],
        $donneeClim['dc_precipitation'],$donneeClim['dc_ensoleillement'],$donneeClim['dc_rafales'],
        $donneeClim['dc_date']));
        //libération de la mémoire
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
        return getDonneeClimById($donneeClim['dc_id']);
    }

    function deleteDonneeClim(int $id): void  {
        $ptrDB = connexion();
    
        //préparation de la requête
        $query = "DELETE FROM g06_donneesclimatiques WHERE dc_id=$1";
        pg_prepare($ptrDB,"reqDelDC",$query);
        //execution de la requête
        $ptrQuery = pg_execute($ptrDB,"reqDelDC",array($id));
        //libération de ma mémoire
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
    }
?>