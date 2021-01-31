<?php
session_start();

require_once "models/Kunde.php";


    if(!isset($_SESSION['login']))
    {
        header('Location:' . "index.php");
        exit();
    }

    if (empty($_SESSION['userid']))
    {
        header("Location: index.php");
        exit();
    }
    else if (!is_numeric($_SESSION['userid']))
    {
        http_response_code(400);
        die();
    }
    else
    {
    // load single item per ID
        $user = Kunde::get($_SESSION['userid']);

    }
?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Bank</title>





</head>
<body>
<div class="container">
    <h1 class = "text-center" = "ml-4 mt-5">Bankkonto</h1>





    <table class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th>Vorname</th>
            <td><?=$user->getVorname()?></td>
        </tr>
        <tr>
            <th>Nachname</th>
            <td><?=$user->getNachname()?></td>
        </tr>
        <tr>
            <th>Kontostand</th>
            <td><?=$user->getKontostand()?></td>
        </tr>
        <tr>
            <th>IBAN</th>
            <td><?=$user->getIban()?></td>
        </tr>
        <tr>
            <th>BIC</th>
            <td><?=$user->getBic()?></td>
        </tr>
        <tr>
            <th>Verfügernummer</th>
            <td><?=$user->getVerfügernr()?></td>
        </tr>
        </tbody>
    </table>


    </div>

<div class = "text-center" >

    <a href="überweisung.php" class="btn btn-info btn-lg">
        <span class="glyphicon glyphicon-log-out"></span> Überweisung
    </a>

</div>
<div class = "text-center" >

    <a href="logoff.php" class="btn btn-info btn-lg">
        <span class="glyphicon glyphicon-log-out"></span> Log out
    </a>

</div>


</body>

