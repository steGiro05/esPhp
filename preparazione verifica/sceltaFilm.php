<?php
session_start();
if (isset($_POST['scelta'])) {
    $_SESSION['scelta'] = $_POST['scelta'];
}

header('Location: index.php');
