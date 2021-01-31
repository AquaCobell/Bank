<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Wochenkarte</title>

    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>



<?php

require_once "models/CookieHelper.php";
require_once "models/User.php";


$u = new User();

$message = "";


    if(!checkCookie())
    {
        //cookiesetter();
        showCookie();

        if (isset($_POST["accept"])) {

            cookiesetter();
        }

    }
    else
    {
        if(isset($_POST['login']))
        {
            if ($_POST['password'] == $u->getPassword() && $_POST['email'] == $u->getEmail())
            {
                $_SESSION['login'] = "true";

                header('Location:' . "Wochenkarte.php");
                exit();
            }
            else
            {
                echo  '<div class="alert alert-danger">Zugangsdaten ungültig!</div>';
            }
        }


        ?>

        <div class="container">

            <h1 class="mt-5 mb-3">Wochenkarte</h1>

            <h2 class="ml-4 mt-5">Bitte anmelden</h2>
        <div class="text-center mt-5">
            <form action='?login' method='post'>
                <div class="row">
                <div class="col-sm-4">
                <input class='form-control' type='email' placeholder='Email' name='email'>
                </div>
                <div class="col-sm-4">
                <input class='form-control' type='password' placeholder='Passwort' name='password'>
                </div>
                <input class='btn btn-warning' type='submit' name='login' id='login' value='Anmelden'>
            </form>
        </div>
    </div>
<?php
    }
    ?>
</body>
</html>
