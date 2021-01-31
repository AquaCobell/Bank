<?php
session_start();
require_once "models/Kunde.php";
$pdo = new PDO('mysql:host=localhost;dbname=bank', 'root', '123');

?>

<!doctype html>
<html lang="de">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">

    <title>Bank</title>

    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>
<?php

if(isset($_POST['register'])) {
    $error = false;
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $vorname = $_POST['vorname'];
    $nachname =  $_POST['nachname'];


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }
    if (strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if ($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }
    if (!$error)
    {
        $kunde = new Kunde();
        $kunde->setEmail($email);
        $kunde->setVorname($vorname);
        $kunde->setNachname($nachname);
        $kunde->setPasswort($passwort);
        $kunde->save();
        header('Location: ./index.php');

    }

}

 ?>
        <div class="container">

            <h1 class="mt-5 mb-3">Bank Registrierung</h1>

            <h2 class="ml-4 mt-5">Registrierung</h2>
        <div class="text-center mt-5">
            <form action='?login' method='post'>
                <div class="row">
                <div class="col-sm-4">
                <input class='form-control' type='text' placeholder='Vorname' name='vorname'>
                </div>
                <div class="col-sm-4">
                <input class='form-control' type='text' placeholder='Nachname' name='nachname'>
                </div>
                <div class="col-sm-4">
                <input class='form-control' type='email' placeholder='Email' name='email'>
                </div>
                <div class="col-sm-4">
                <input class='form-control' type='password' placeholder='Passwort' name='passwort'>
                </div>
                <div class="col-sm-4">
                <input class='form-control' type='password' placeholder='Passwort bestätigen' name='passwort2'>
                </div>
                <input class='btn btn-warning' type='submit' name='register' id='register' value='Registrieren'>
            </form>
        </div>
    </div>
<?php

    ?>
</body>
</html>
