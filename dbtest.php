<!DOCTYPE html>
<html> 
<head>
	<meta charset="UTF-8" />
	<title>DB-Test</title> 
</head>
 
<body>
<?php
include "db_utils.php";
try {
    $dbConnection = Dbutils\connect();
    $result = Dbutils\queryParams($dbConnection, "SELECT * FROM public.user", null);
    // Ergebnisse in HTML ausgeben
    echo "<table>\n";
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";
} catch(Exception $e) {
    error_log($e->get_Message());
} finally {
    Dbutils\freeResult($result);
    Dbutils\close($dbConnection);
}
?>
</body>
</html>