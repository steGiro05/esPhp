<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon</title>
    <link rel="stylesheet" href="stile.css">

</head>

<body>
    <h1>Pokemon</h1>
    <?php
    require("config.php");
    $mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
    if ($mydb->connect_errno) {
        echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        exit();  //termina la pagina
    }

    $query = "SELECT * FROM pokemon";
    $risultato = $mydb->query($query);

    if ($risultato->num_rows > 0) {
        echo "<table>";
        echo "<tr><td>Nome</td><td>Tipo</td><td>Tipo2</td></tr>";
        //ciclo i risultati, cioè l'elenco delle mamme presenti nel database
        while ($pokemon = $risultato->fetch_assoc()) {
            echo '<tr>';
            echo "<td>" . $pokemon["nome"] . "</td>";
            echo "<td>" . $pokemon["tipo"] . "</td>";
            echo "<td>" . $pokemon["tipo2"] . "</td>";
            echo '</tr>';
        }
        echo "</table>";
    } else {
        echo "<p>Non ci sono pokemon nel database.</p>";
    }

    ?>
</body>

</html>