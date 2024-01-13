<?php
session_start();

if (isset( $_POST["nomeFilm"] )){
require('config.php');
$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}  
    $stmt1 = $mydb->prepare("SELECT id FROM film  WHERE titolo = (?)");
    $stmt1->bind_param("s",  $_POST['nomeFilm']);
    echo $stmt1;    
    $_SESSION['film'] = $stmt1->execute();
    $stmt1->close();
}

header('Location: cancellaFilm.php');


