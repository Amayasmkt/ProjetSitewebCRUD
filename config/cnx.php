<?php
require(__DIR__ . '/monEnv.php');
function connexion() {
    $dbHost = $_ENV['dbHost'];
    $dbName = $_ENV['dbName'];
    $dbUser = $_ENV['dbUser'];
    $dbPassword = $_ENV['dbPasswd'];
    $strConnex = "host=$dbHost dbname=$dbName user=$dbUser password=$dbPassword";
    $ptrDB = pg_connect($strConnex);
    return $ptrDB;
}
?>