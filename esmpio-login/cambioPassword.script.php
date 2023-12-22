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
        $stmt1 = $mydb->prepare("SELECT hash FROM utenti  WHERE nome = (?)");
        $stmt1->bind_param("s",  $_SESSION['nome']);
        $oldHash = $stmt1->execute();
        $oldPw = password_hash($_POST['oldPw'], PASSWORD_DEFAULT);
        $stmt1->close();


        if ($oldHash == $oldPw) {


            $stmt = $mydb->prepare("UPDATE utenti SET hash = (?) WHERE nome = (?)");
            $newHash = password_hash($_POST['newPw'], PASSWORD_DEFAULT);
            $stmt->bind_param("ss", $newHash, $_SESSION['nome']);
            $stmt->execute();
            $stmt->close();
        } else {
            echo '<script>alert("Questo è un messaggio di avviso!");</script>';
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