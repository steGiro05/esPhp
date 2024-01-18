<?php
session_start();
require('config.php');
$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
if ($mydb->connect_errno) {
    echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}

$id = $_GET['idFilm'];

$stmt1 = $mydb->prepare("DELETE FROM appartiene WHERE fkFilm= (?)");
$stmt1->bind_param("s", $id);
$stmt1->execute();
$stmt1->close();

$stmt2 = $mydb->prepare("DELETE FROM recita WHERE fkFilm= (?)");
$stmt2->bind_param("s", $id);
$stmt2->execute();
$stmt2->close();

$stmt3 = $mydb->prepare("DELETE FROM film WHERE id= (?)");
$stmt3->bind_param("s", $id);
$stmt3->execute();
$stmt3->close();



header('Location: cancellaFilm.php');
