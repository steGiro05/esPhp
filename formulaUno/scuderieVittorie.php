<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php
/*instauro la connessione al database */
require("config.php");  //file di config con i parametri di connessione
$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();  //termina la pagina
}

$query = "SELECT scuderia.id as id,scuderia.nome as nome,count(*) as nGareVinte
FROM pilota
INNER JOIN partecipa ON id = fkPilota 
INNER JOIN scuderia ON pilota.fkScuderia=scuderia.id
WHERE posizione=1 
GROUP BY scuderia.id 
ORDER BY nGareVinte DESC";
$risultato = $mydb->query($query);


if ($risultato->num_rows > 0) {
    //ciclo i risultati, cioè l'elenco delle mamme presenti nel database
    echo '<table>';
    echo "<tr><th>Id</th><th>Scuderia</th><th>Numero gare vinte</th></tr>";

    while ($res = $risultato->fetch_assoc()) {


        echo '<tr>';
        echo "<td>" . $res["id"] . "</td>";
        echo "<td>" . $res["nome"] . "</td>";
        echo "<td>" . $res["nGareVinte"] . "</td>";
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "<p>Non ci sono scuderie nel database.</p>";
}
echo '<a href="index.php">Back</a>'

?>


</html>