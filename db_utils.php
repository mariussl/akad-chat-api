<?php
namespace AkadChat\Dbutils;
require "settings.php";
function connect() {
    $dbConnection = false;
    $params = sprintf("host=". \AkadChat\Settings\dbHost ." dbname=". \AkadChat\Settings\dbName ." user=". \AkadChat\Settings\dbUser ." password=". \AkadChat\Settings\dbPassword ." connect_timeout=5");
    $dbConnection = pg_connect($params);
    if (!$dbConnection) {
        $error = pg_last_error();
        $msg = "Verbindungsaufbau zu \"$params\" fehlgeschlagen: $error";
        throw new \Exception($msg);
    }    
    return $dbConnection;
}

function close($dbConnection) {
    if ($dbConnection != null) {
        pg_close($dbConnection);
    }
}

function queryParams($dbConnection, $query, $params) {
    $result = false;
    if ($params == null) {
        $params = [];
    }
    $result = pg_query_params($dbConnection, $query, $params);
    if (!$result) {
        $error = pg_last_error();
        $msg = "Query \"$query\" mit Parametern \"$params\" fehlgeschlagen: $error";
        throw new \Exception($msg);
    }
    return $result;
}

function freeResult($result) {
    pg_free_result($result);
}

?>