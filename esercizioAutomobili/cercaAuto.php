<?php

if ($_POST['anno'] != '' || $_POST['km'] != '' || $_POST['alimentazione'] != '' || $_POST['kw'] != '') {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Auto Trovate</title>
    </head>

    <body>
        <h1>Auto Trovate</h1>
        <?php
        require("config.php");  //file di config con i parametri di connessione
        $mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
        if ($mydb->connect_errno) {
            echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            exit();  //termina la pagina
        }
        $anno = $_POST["anno"];
        $km = $_POST["km"];
        $alimentazione = $_POST["alimentazione"];
        $kw = $_POST["kw"];
        $query = "SELECT * FROM auto WHERE id!=-1";
        if ($anno != '') {
            $query = $query . ' AND anno=' . $anno;
        }
        if ($km != '') {
            $query = $query . ' AND chilometri=' . $km;
        }
        if ($alimentazione != '') {
            $query = $query . ' AND alimentazione=' . "'" . $alimentazione . "'";
        }
        if ($kw != '') {
            $query = $query . ' AND kw=' . $kw;
        }
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
            echo "<p>Nessuna auto con questi parametri.</p>";
        }

        echo '<br>';
        echo "<a href='search.php'>Back</a>";
        ?>


    </body>

    </html>
<?php
} else {
    header('Location: search.php');

    //se non ho passato i dati tramite post, mi rimanda al form
    exit;
}
