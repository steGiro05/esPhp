<?php
session_start();
$stmt1 = $mydb->prepare("SELECT id FROM film  WHERE nome = (?)");
$stmt1->bind_param("s",  $_POST['nomeFilm']);
$_SESSION['nomeFilm'] = $stmt1->execute();
$stmt1->close();
