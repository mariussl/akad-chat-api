<!DOCTYPE html>
<html> 
<head>
	<meta charset="UTF-8" />
	<title>DB-Test</title> 
</head>
 
<body>
<?php
// Verbindungsaufbau und Auswahl der Datenbank
$dbconn = pg_connect("host=rose.schubs.at dbname=chatdb user=chat password=chat")
    or die('Verbindungsaufbau fehlgeschlagen: ' . pg_last_error());

// Eine SQL-Abfrage ausführen
$query = 'SELECT * FROM public.user';
$result = pg_query($query) or die('Abfrage fehlgeschlagen: ' . pg_last_error());

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

// Speicher freigeben
pg_free_result($result);

// Verbindung schließen
pg_close($dbconn);
?>
</body>
</html>