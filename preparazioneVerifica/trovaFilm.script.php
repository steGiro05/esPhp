<?php
session_start();

if (isset($_POST["nomeFilm"])) {
    require('config.php');
    $mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
    if ($mydb->connect_errno) {
        echo "Errore nella connessione a MySQL: (" . $mydb->connect_errno . ") " . $mydb->connect_error;
        exit();
    }

    $stmt = $mydb->prepare("SELECT id, titolo FROM film WHERE titolo LIKE (?)");
    $nomeFilm = $_POST["nomeFilm"] .= '%';
    $stmt->bind_param("s", $nomeFilm);
    $stmt->execute();

    $stmt->store_result();  // Memorizza il risultato per ottenere il numero di righe

    if ($stmt->num_rows > 0) {
        // Ci sono risultati
        $stmt->bind_result($id, $titolo);

        // Fetch dei risultati
        while ($stmt->fetch()) {
            $_SESSION['filmId'] = $id;
            $_SESSION["filmTitolo"] = $titolo;
            $_SESSION['erroreCanc'] = false;
        }
    } else {
        // Nessun risultato
        $_SESSION['erroreCanc'] = true;
    }

    $stmt->close();
    $mydb->close();
}




header('Location: cancellaFilm.php');
