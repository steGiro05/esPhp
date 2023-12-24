<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
    <?php
    session_start();
    //se il login non viene effettuato correttamente,
    //questo flag permetterà di segnalare l'errore all'utente

    if (isset($_POST["newPw"]) && isset($_POST['oldPw']) && isset($_SESSION['nome'])) {


        //connessione al database
        require("config.php"); //parametri di connessione
        $mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
        if ($mydb->connect_errno) {
            echo "Errore nella connessione a MySQL: (" . $mydb->connect_errno . ") " . $mydb->connect_error;
            exit();
        }

        $stmt1 = $mydb->prepare("SELECT hash FROM utenti  WHERE id = (?)");
        $stmt1->bind_param("s",  $_SESSION['id']);
        $stmt1->execute();
        $stmt1->bind_result($oldHash);
        while ($stmt1->fetch()) { //eseguirà solo una iterazione
            $_SESSION['oldHash'] = $oldHash;
        }


        $stmt1->close();




        if (password_verify($_POST['oldPw'], $oldHash)) {
            $stmt = $mydb->prepare("UPDATE utenti SET hash = (?) WHERE id = (?)");
            $newHash = password_hash($_POST['newPw'], PASSWORD_DEFAULT);
            $stmt->bind_param("ss", $newHash, $_SESSION['id']);
            $stmt->execute();

            $stmt->close();
        } else {
            $_SESSION['erroreCambioPw'] = true;
            header('Location: cambioPassword.php');
        }
    }

    //ritorna alla pagina invocante	

    ?>
</head>

<body>
    <h2>Password cambiata correttamente!</h2>
    <a href="areaPrivata.php">Back</a>
</body>

</html>