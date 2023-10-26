<html>

<head>
	<title>Elenco automobili</title>
	<link rel="stylesheet" href="stile.css">
</head>

<body>
	<h1>Elenco Automobili</h1>
	<?php
	/*instauro la connessione al database */
	require("config.php");  //file di config con i parametri di connessione
	$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
	if ($mydb->connect_errno) {
		echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		exit();  //termina la pagina
	}

	$query = "SELECT marca,modello,anno,id FROM auto";
	$risultato = $mydb->query($query);


	if ($risultato->num_rows > 0) {
		//ciclo i risultati, cioè l'elenco delle mamme presenti nel database
		echo '<table>';
		echo "<tr><th>Marca</th><th>Modello</th><th>Anno</th></tr>";

		while ($auto = $risultato->fetch_assoc()) {
			// echo '<td>';
			// echo "<a href='auto.php?id=" . $auto['id'] . "'>" . $auto["marca"] . ' ' . $auto["modello"] . " (" . $auto['anno'] . ')' . "</a>";
			// echo '</td>';

			echo '<tr>';
			echo "<td>" . "<a href='auto.php?id=" . $auto['id'] . "'>" . $auto["marca"] . "</a>" . "</td>";
			echo "<td>" . $auto["modello"] . "</td>";
			echo "<td>" . $auto["anno"] . "</td>";
			echo '</tr>';
		}

		echo '</table>';
	} else {
		echo "<p>Non ci sono auto nel database.</p>";
	}

	//query per prelevare l'elenco delle mama

	?>

</body>

</html>