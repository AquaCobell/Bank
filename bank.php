<?php
session_start();

require_once "models/Kunde.php";


    if(!isset($_SESSION['login']))
    {
        header('Location:' . "index.php");
    }
?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Wochenkarte</title>





</head>
<body>
<div class="container">
    <h1 class = "text-center" = "ml-4 mt-5">Wochenkarte</h1>


    <div class = "row">
        <div class="col-sm-3 text-center">
            <p>Montag</p>
            <img src="img/hendl.jpg"  style="width: 150px; height: 150px;"></img>
        </div>
        <div class="col-sm-3 text-center">
            <p>Dienstag</p>
            <img src="img/schweinsbraten.jpg"  style="width: 150px; height: 150px;"></img>
        </div>
        <div class="col-sm-3 text-center">
            <p>Mittwoch</p>
            <img src="img/ramen.jpg"  style="width: 150px; height: 150px;"></img>
        </div>
        <div class="col-sm-3 text-center">
            <p>Donnerstag</p>
            <img src="img/toast.jpg"  style="width: 150px; height: 150px;"></img>
        </div>
        <div class="col-sm-3 text-center">
            <p>Freitag</p>
            <img src="img/burger.jpg"  style="width: 150px; height: 150px;"></img>
        </div>




    </div>
    <div class = "text-center" >

            <a href="logoff.php" class="btn btn-info btn-lg">
                <span class="glyphicon glyphicon-log-out"></span> Log out
            </a>

    </div>



    </div>







</body>

