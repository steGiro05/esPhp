<?php
session_start(); //attenzione! la sessione va avviata prima di qualunque output!
//compresi spazi vuoti etc
?>
<html>

<head>
    <title>Esempio di login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Login</h1>
    <?php
	//verifico se è loggato o meno:
	//se non è loggato mostro il form per loggarsi
	//se è già loggato lo saluto
	if (isset($_SESSION["nome"])) {
		//pannello di controllo utente
		header('Location: areaPrivata.php');
	?>

    <?php
	} else {
		//non è loggato quindi mostro il form
	?>

    <form id="login" name="login" method="post" action="login.script.php">

        <label for="usr">Nome utente</label>
        <?php
			if (isset($_COOKIE['nickname'])) {
				$val = $_COOKIE['nickname'];
			} else $val = '';

			echo '<input value="' . $val . '" type="text" placeholder="Inserisci username" name="usr" required>'
			?>


        <label for="pwd">Password</label>
        <input type="password" placeholder="Inserisci password" name="pwd" required>

        <input type="submit" name="submit" value="Login">
        <a href="signup.php">Non sei registrato?</a>
    </form>
    <?php
		//comunico anche l'eventuale tentativo errato di login
		if (isset($_SESSION["errore_login"]) && $_SESSION["errore_login"] == true) {
			echo "<p class='error-message'>Nome utente o password errati! Ritenta!</p>";
			unset($_SESSION["errore_login"]);
		}
	}
	?>
</body>

</html>