<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio Password</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (!isset($_SESSION['nome'])) {
        header('Location: login.php');
    }

    if (isset($_SESSION['erroreCambioPw'])) {

        unset($_SESSION['erroreCambioPw']);
        echo '<script>alert("Password sbagliata!");</script>';
    }


    ?>
    <h1>Cambio Password</h1>
    <form action="cambioPassword.script.php" method="post">

        <label for="oldPw">Vecchia Password</label>
        <input type="password" placeholder="Inserisci password.." name="oldPw" required>

        <label for="newPw">Nuova Password</label>
        <input type="password" placeholder="Inserisci password.." name="newPw" required>

        <input type="submit" name="submit" value="Cambia Password">

        <a href="areaPrivata.php">Back</a>
    </form>




</body>

</html>