<?php
session_start();
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
    <form action="cancellaFilm.script.php" method="post" >
        <label for="nomeFilm">Film da cancellare:</label>
        <input type="text" name="nomeFilm" id="nomeFilm" placeholder="Titolo..">
        <button type="submit">Cancella</button>
    </form>

    <?php
        echo $_SESSION['film'];
    ?>

    <br>
    <a href="index.php">Indietro..</a>
</body>

</html>