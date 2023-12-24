<?php
session_start();
unset($_SESSION["errore_signup"]);
//se il login non viene effettuato correttamente,
//questo flag permetterà di segnalare l'errore all'utente

if (isset($_POST["usr"])) {


    //connessione al database
    require("config.php"); //parametri di connessione
    $mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
    if ($mydb->connect_errno) {
        echo "Errore nella connessione a MySQL: (" . $mydb->connect_errno . ") " . $mydb->connect_error;
        exit();
    }
    //la connessione è andata a buon fine: eseguo la query
    //questa volta utilizzo le prepared statements
    //per prevenire tentativi di sql injections
    //esempio: 
    //$stringa = "'ciao' OR 1 = 1";
    //$query = "SELECT nome, password FROM utenti WHERE username = ".$stringa;
    //otterrei come query: SELECT nome, password FROM utenti WHERE username = 'ciao' OR 1 = 1

    //select: prepared statement con segnaposto (?) per parametro
    $stmt = $mydb->prepare("INSERT INTO utenti (nome, hash) VALUES ((?), (?))");
    //associo il parametro col tipo (s per stringa)
    $hash = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    $stmt->bind_param("ss", $_POST["usr"], $hash);
    //eseguo la query
    try {
        $stmt->execute();
    } catch (Exception $e) {
        // Gestione dell'eccezione
        $_SESSION["errore_signup"] = true;

        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>Document</title>
    <link rel="stylesheet" href="style.css">

        </head>
        <body>
        <p class="error-message">Utente già registrato</p>
        <a href="signup.php">Back</a>
        </body>
        </html>';
    }


    //chiudo statement
    $stmt->close();
}

//ritorna alla pagina invocante	
if (!isset($_SESSION["errore_signup"])) {
    $_SESSION["nome"] = $_POST["usr"];

    header("Location: login.php");
    exit();
}
