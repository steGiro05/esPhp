<html>

<head>
    <title>Specifica Auto</title>
    <link rel="stylesheet" href="stile.css">
</head>

<body>
    <h1>Specifica Auto</h1>
    <?php
    /*instauro la connessione al database */
    require("config.php");  //file di config con i parametri di connessione
    $mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
    if ($mydb->connect_errno) {
        echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        exit();  //termina la pagina
    }

    $query = "SELECT * FROM auto
    WHERE id=" . $_GET['id'] . "";
    $risultato = $mydb->query($query);


    if ($risultato->num_rows > 0) {
        //ciclo i risultati, cioè l'elenco delle mamme presenti nel database
        echo "<table>";
        echo "<tr><th>Marca</th><th>Modello</th><th>Allestimento</th><th>Anno</th><th>Chilometri</th><th>Alimentazione</th><th>Cambio</th><th>Kw</th><th>Prezzo</th></tr>";

        //ciclo i risultati, cioè l'elenco delle mamme presenti nel database
        while ($auto = $risultato->fetch_assoc()) {
            echo '<tr>';
            echo "<td>" . $auto["marca"] . "</td>";
            echo "<td>" . $auto["modello"] . "</td>";
            echo "<td>" . $auto["allestimento"] . "</td>";
            echo "<td>" . $auto["anno"] . "</td>";
            echo "<td>" . $auto["chilometri"] . "</td>";
            echo "<td>" . $auto["alimentazione"] . "</td>";
            echo "<td>" . $auto["cambio"] . "</td>";
            echo "<td>" . $auto["kw"] . "</td>";
            echo "<td>" . $auto["prezzo"] . "</td>";
            echo '</tr>';
        }
        echo "</table>";
    } else {
        echo "<p>Non ci sono auto nel database.</p>";
    }

    echo '<br>';
    echo "<a href='elenco.php'>Back</a>";


    //query per prelevare l'elenco delle mama

    ?>

</body>

</html>