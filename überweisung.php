<?php

session_start();

require_once "models/Kunde.php";
require_once "models/Ueberweisung.php";


if (!isset($_SESSION['login'])) {
    header('Location:' . "index.php");
    exit();
}

if (empty($_SESSION['userid'])) {
    header("Location: index.php");
    exit();
}
else if (!is_numeric($_SESSION['userid'])) {
    http_response_code(400);
    die();
}
else
{
    // load single item per ID
    $user = Kunde::get($_SESSION['userid']);
    $u = new Ueberweisung();
    $ueberweisung = Ueberweisung::getUberweisungperIban($user->getIban());
    //print_r($ueberweisung);
    //print_r(gettype($ueberweisung));
    //if($ueberweisung == null)
    //{
        //print_r($ueberweisung);
    //}
    //echo '$ueberweisung';

}
if(isset($_POST['ueberweisen']))
{

    $error = false;

    $ibanempfaenger = $_POST['IBAN'];
    $bicempfaenger = $_POST['BIC'];
    $zahlungsreferenz = $_POST['Zahlungsreferenz'];
    $verwendungszweck = $_POST['Verwendungszweck'];
    $betrag = $_POST['Betrag'];
    $ibansender = $user->getIban();
    $bicsender = $user->getBic();
    $absenderid = $user->getId();
    $empfaenger = Kunde::getKundewithIban($ibanempfaenger);
    $empfaengerid = $empfaenger->getId();
    $datum = time();




    $ueberweisung1 = new Ueberweisung();
    $ueberweisung1->setIbansender($ibansender);
    $ueberweisung1->setbicsender($bicsender);
    $ueberweisung1->setabsenderid($absenderid);
    $ueberweisung1->setempfaengerid($empfaengerid);
    $ueberweisung1->setZahlungsreferenz($zahlungsreferenz);
    $ueberweisung1->setVerwendungszweck($verwendungszweck);
    $ueberweisung1->setbetrag($betrag);
    $ueberweisung1->setdatum($datum);
    $ueberweisung1->setIbanempfaenger($ibanempfaenger);
    $ueberweisung1->setBicempfaenger($bicempfaenger);
    $ueberweisung1->save();
    header('Location: ./bank.php');



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
        <h1 class="text-center" = "ml-4 mt-5">Bankkonto</div>


        <div class="container">

            <h1 class="mt-5 mb-3">Überweisung</h1>

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
                            <input class='form-control' type='text' placeholder='Verwendungszweck' name='Verwendungszweck'>
                        </div>
                        <input class='btn btn-warning' type='submit' name='ueberweisen' id='ueberweisen' value='Überweisen'>

                        <?php

                            //print_r(gettype($ueberweisung));
                            if (is_object($ueberweisung)) {

                                //print_r($ueberweisung);
                                echo "<div class='test'>";

                                foreach ($ueberweisung as $item)
                                {
                                    echo "<p>test</p>";
                                    
                                   
                                   
                                    


                                    //echo '<td>' . $item['ibansender'] . '</td>';
                                    //echo '<td>' . $item->$u->getBetrag() . '</td>';
                                    //echo "<td>" . $item['betrag'] . "</td>";
                                    //echo '<td>' . $item->$u->getBicempfaenger() . '</td>';
                                    //echo '<td>' . $item->$u->getBicempfaenger() . '</td>';
                                    //echo '<td>' . $item->$u->getZahlungsreferenz() . '</td>';
                                    //echo '<td>' . $item->$u->getVerwendungszweck() . '</td>';
                                    //echo '<td>' . $item->$u->getBetrag() . '</td>';
                                    //echo '<td>' . $item->$u->getDatum() . '</td>';
                                    //echo '<td>';
                                    //echo "</tr>";
                                }
                                 echo "</div>";
                            }


                        ?>



            </div>
        </div>
    </div>

<div class="text-center">

    <a href="bank.php" class="btn btn-info btn-lg">
        <span class="glyphicon glyphicon-log-out"></span> Konto
    </a>

</div>


</body>

