<?php
session_start();

require('config.php');
$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
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
    <h1>Cancella Film</h1>
    <form action="trovaFilm.script.php" method="post">
        <label for="nomeFilm">Film da cancellare:</label>
        <input type="text" name="nomeFilm" id="nomeFilm" placeholder="Titolo..">
        <button type="submit">Cancella</button>
    </form>

    <?php
    if (isset($_SESSION['filmId']) && isset($_SESSION["filmTitolo"]) && isset($_SESSION['erroreCanc']) && !$_SESSION['erroreCanc']) {
        $nomeFilm = $_SESSION["filmTitolo"];
        $idFilm = $_SESSION['filmId'];
        $nomeFilm = str_replace("'", ' ', $nomeFilm);
        echo "<script>
        var conferma = confirm('Sei sicuro di voler eliminare il film:" . $nomeFilm . "?');

        if (conferma) {
            // L'utente ha confermato, invia una richiesta al server per l'eliminazione
            window.location.href = 'cancellaFilm.script.php?idFilm=$idFilm';
        } else {
            // L'utente ha annullato, non fare nulla
        }
    </script>";


        unset($_SESSION['erroreCanc']);
    } elseif (isset($_SESSION['erroreCanc']) && $_SESSION['erroreCanc']) {
        echo
        "<script>
        window.onload = function() {
            alert('Film non trovato');
        };
        </script>";
        unset($_SESSION['erroreCanc']);
    }

    ?>

    <br>
    <a href="index.php">Indietro..</a>
</body>

</html>