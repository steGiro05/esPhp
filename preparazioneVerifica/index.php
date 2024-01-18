<?php
require('config.php');
$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}

$film = [];

$query1 = "SELECT id,titolo from film";
$risultato1 = $mydb->query($query1);

if ($risultato1->num_rows > 0) {
    while ($data = $risultato1->fetch_assoc()) {
        array_push($film, $data);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Film</h1>
    <form action="index.php" method="post">
        <label for="scelta">Seleziona una opzione:</label>
        <select id="scelta" name="scelta">
            <option value="" <?php echo (empty($_POST['scelta'])) ? 'selected' : ''; ?>></option>
            <?php
            foreach ($film as $value) {
                $selected = ($_POST['scelta'] == $value['id']) ? 'selected' : '';
                echo '<option value="' . $value['id'] . '" ' . $selected . '>' . $value['titolo'] . '</option>';
            }
            ?>
        </select>
        <button type="submit">Invia</button>
    </form>

    <?php
    if (isset($_POST['scelta'])) {

        if ($_POST['scelta'] != '') {
            $query = "SELECT nome,cognome 
        from recita
        inner join film on recita.fkFilm=film.id
        inner join attore on recita.fkAttore=attore.id
        where film.id='" . $_POST['scelta'] . "'
        ";

            $risultato = $mydb->query($query);

            if ($risultato->num_rows > 0) {
                echo '<h2>Attori</h2>';

                echo '<table>';
                echo "<tr><th>Nome</th><th>Cognome</th></tr>";

                while ($attori = $risultato->fetch_assoc()) {


                    echo '<tr>';
                    echo "<td>" . $attori["nome"] . "</td>";
                    echo "<td>" . $attori["cognome"] . "</td>";
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo "<p>Non ci sono attori in questo film.</p>";
            }
        }
    };
    ?>

    <br>
    <a href="cancellaFilm.php">Cancella film..</a>

</body>

</html>