<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=bank', 'root', '123');

require_once "models/Kunde.php";

?>

<!doctype html>
<html lang="de">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Bank</title>

    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>



<?php

require_once "models/CookieHelper.php";
require_once "models/kunde.php";


$u = new kunde();

$message = "";


    if(!checkCookie())
    {
        //cookiesetter();
        showCookie();

        if (isset($_POST["accept"]))
        {
            cookiesetter();
        }

    }
    else
    {
        if(isset($_GET['login'])) {
            $email = $_POST['email'];
            $passwort = $_POST['passwort'];

            $kunde = Kunde::getKundewithEmail($email);
            if($kunde->getPasswort() == $passwort && $kunde->getEmail() == $email  )
            {
                $_SESSION['userid'] = $kunde->getID();
                $_SESSION['login'] = "true";

                //$_SESSION['userid'] = $user['id'];
                header('Location: ./bank.php');
            }
            else
            {
                echo  '<div class="alert alert-danger">Zugangsdaten ungültig!</div>';
            }
        }


        ?>

        <div class="container">

            <h1 class="mt-5 mb-3">Bank</h1>

            <h2 class="ml-4 mt-5">Bitte anmelden</h2>
        <div class="text-center mt-5">
            <form action='?login' method='post'>
                <div class="row">
                <div class="col-sm-4">
                <input class='form-control' type='email' placeholder='Email' name='email'>
                </div>
                <div class="col-sm-4">
                <input class='form-control' type='password' placeholder='Passwort' name='passwort'>
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
