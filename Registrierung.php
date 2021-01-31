<?php
session_start();

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

if(isset($_GET['Registrierung'])) {
    $error = false;
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];


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
    if (!$error) {
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if ($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }
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
                <input class='form-control' type='text' placeholder='vorname' name='vorname'>
                </div>
                <div class="col-sm-4">
                <input class='form-control' type='text' placeholder='nachname' name='nachname'>
                </div>
                <div class="col-sm-4">
                <input class='form-control' type='email' placeholder='email' name='email'>
                </div>
                <div class="col-sm-4">
                <input class='form-control' type='password' placeholder='passwort' name='passwort'>
                </div>
                <div class="col-sm-4">
                <input class='form-control' type='password' placeholder='passwort2' name='passwort bestätigen'>
                </div>
                <input class='btn btn-warning' type='submit' name='login' id='login' value='Anmelden'>
            </form>
        </div>
    </div>
<?php

    ?>
</body>
</html>
