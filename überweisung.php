<?php

session_start();

require_once "models/Kunde.php";


if (!isset($_SESSION['login'])) {
    header('Location:' . "index.php");
    exit();
}

if (empty($_SESSION['userid'])) {
    header("Location: index.php");
    exit();
} else if (!is_numeric($_SESSION['userid'])) {
    http_response_code(400);
    die();
} else {
    // load single item per ID
    $user = Kunde::get($_SESSION['userid']);

}
?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Bank</title>


</head>
<body>
    <div class="container">
        <h1 class="text-center" = "ml-4 mt-5">Bankkonto</h1>


        <div class="container">

            <h1 class="mt-5 mb-3">Überweisung</h1>
//IBAN BIC Zahlungsreferenz verwendungszweck betrag in euro datum und uhrzeit
            <h2 class="ml-4 mt-5">Bitte Daten angeben</h2>
            <div class="text-center mt-5">
                <form action='?überweisen' method='post'>
                    <div class="row">
                        <div class="col-sm-4">
                            <input class='form-control' type='text' placeholder='IBAN' name='IBAN'>
                        </div>
                        <div class="col-sm-4">
                            <input class='form-control' type='text' placeholder='BIC' name='BIC'>
                        </div>
                        <div class="col-sm-4">
                            <input class='form-control' type='number' placeholder='Betrag' name='Betrag'>
                        </div>
                        <div class="col-sm-4">
                            <input class='form-control' type='text' placeholder='Zahlungsreferenz' name='Zahlungsreferenz'>
                        </div>
                        <div class="col-sm-4">
                            <input class='form-control' type='text' placeholder='Zahlungszweck' name='Zahlungszweck'>
                        </div>
                        <input class='btn btn-warning' type='submit' name='login' id='login' value='Überweisen'>
                </form>
            </div>
        </div>
    </div>




</body>

