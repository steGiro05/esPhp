<html>

<head>
    <title>Elenco couni</title>
    <link rel="stylesheet" href="stile.css">
</head>

<body>
    <?php
    /*instauro la connessione al database */
    require("config.php");  //file di config con i parametri di connessione
    $mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
    if ($mydb->connect_errno) {
        echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        exit();
    }

    $query1 = "SELECT id,nome FROM regioni";
    $risultato1 = $mydb->query($query1);

    if ($risultato1->num_rows > 0) {
        while ($regione = $risultato1->fetch_assoc()) {
            echo "<h1>" . $regione["nome"]  . "</h1>";

            $query2 = "SELECT id, nome, abitanti 
            				FROM citta 
            				WHERE fkRegione = " . $regione["id"] . "
            				ORDER BY abitanti DESC ";
            $risultato2 = $mydb->query($query2);
            if ($risultato2->num_rows > 0) {
                while ($citta = $risultato2->fetch_assoc()) {
                    echo "<div class='contenitore'>";
                    echo "<h3>" . $citta["nome"] . "</h3>";
                    echo "<p>" . '(abitanti: ' . $citta["abitanti"] . ')' . "</p>";
                    echo '</div>';
                    echo '<br>';

                    $query3 = 'SELECT nome, abitanti
                                    FROM comuni
                                    WHERE fkCitta = ' . $citta['id'] . '
                                    ORDER BY abitanti DESC ';
                    $risultato3 = $mydb->query($query3);
                    if ($risultato3->num_rows > 0) {
                        //ci sono dei risultati, quindi inizio ad impostare la tabella
                        echo "<table>";
                        echo "<tr><td>Nome</td><td>Abitanti</td></tr>";
                        //stampo le singole righe della tabella
                        while ($comune = $risultato3->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $comune["nome"] . "</td>";
                            echo "<td>" . $comune["abitanti"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "<br>";
                    } else {
                        echo "<p>Non risultano comuni per questa città.</p>";
                    }
                }
            } else {
                echo "<p>Non risultano città per questa regione.</p>";
            }
        }
    } else {
        echo "<p>Non ci sono regioni nel database.</p>";
    }

    ?>

</body>

</html>