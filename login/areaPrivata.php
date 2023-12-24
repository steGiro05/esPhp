<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area privata</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (!isset($_SESSION['nome'])) {
        header('Location: login.php');
    }
    ?>
    <h1>Area privata</h1>
    <h2>Ciao <?php echo $_SESSION["nome"]; ?></h2>
    <p><a href="logout.script.php">Clicca per il logout</a></p>
    <p><a href="cambioPassword.php">Cambio password</a></p>

</body>

</html>