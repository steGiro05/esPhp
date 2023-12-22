<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <h1>Registrati</h1>
    <form name="signUp" action="signup.script.php" method="post">

        <label for="usr">Nome utente</label>
        <input type="text" placeholder="Inserisci username" name="usr" required>

        <label for="pwd">Password</label>
        <input type="password" placeholder="Inserisci password" name="pwd" required>


        <input type="submit" name="submit" value="SignUp">
        <a href="login.php">Back</a>
    </form>

</body>

</html>