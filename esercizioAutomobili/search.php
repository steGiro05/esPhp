<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="stile.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerca</title>

</head>

<body>
    <h1>Cerca Auto</h1>

    <form name='formAuto' action="cercaAuto.php" method='post'>

        <input type="number" id='anno' name="anno" placeholder="anno..">
        <br>
        <input type="number" id='km' name="km" placeholder="km..">
        <br>
        <select name="alimentazione" id="alimentazione">
            <option value=''></option>
            <option value="Diesel">Diesel</option>
            <option value="Benzina">Benzina</option>
            <option value="Elettrica">Elettrica</option>
        </select>
        <br>
        <input type="number" id='kw' name="kw" placeholder="kw..">
        <br>
        <button type="submit">Cerca</button>
    </form>


</body>

</html>