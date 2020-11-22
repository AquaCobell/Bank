<?php

session_start();

//require_once "models/CookieHelper.php";
require_once "models/User.php";

$u = new User();
$message = "";


if (isset($_POST['submit'])){
    $u->setEmail(isset($_POST['email']) ? $_POST['email'] : '')
        ->setPassword(isset($_POST['password']) ? $_POST['password'] : '');

    if ($u->validate()) {
        $u->save();
        $message = "<p class='alert alert-success'>Die Daten sind in Ordnung!</p>";
    } else {
        $message = "<div class='alert alert-danger'><p>Die Daten sind fehlerhaft!</p><ul>";
        foreach ($u->getErrors() as $key => $value) {
            $message .= "<li>" . $value . "</li>";
        }
        $message .= "</ul></div>";
    }

}

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

<div class="container">

    <h1 class="mt-5 mb-3">Wochenkarte</h1>

</body>
</html>
